<?php

namespace AppDevl\QueryStrategy;

/**
 * A child of this class has the ability to translate expressions it receives.
 *
 * The translation is just a simple global replacement of the string (for now,
 * at least).
 *
 * This allows you to use 1 collection of expressions for 2 or more different
 * database connection approaches.  For example, if you were using Doctrine1
 * for most queries, but ocassionally need to make direct SQL string queries
 * for performance reasons, you could provide a translations array so that
 * your straight SQL expressions can use the same DQL expressions, so that they
 * can use the relationships from your Doctrine model, etc.
 *
 * To use translations, just pass an associative array to the constructor with
 * keys that represent the strings to be replaced, and values that represent
 * the replacement strings.
 *
 * Example:
 *
 *     $translations = array(
 *         "person.PhoneNumbers" => "phone_numbers ON phone_numbers.person_id = person.person_id"
 *     );
 *     $query_strategy = new MysqlStringStrategy($translations);
 *     ...
 *     $query_strategy->leftJoin("person.PhoneNumbers");
 *     // result: LEFT JOIN phone numbers ON phone_numbers.person_id = person.person_id
 *
 * (Once we no longer feel the need to support php 5.3, this functionality
 * should probably be implemented via AOP or Traits, rather than through
 * inheritance.)
 */
abstract class TranslatingStrategy implements StrategyInterface
{
    protected $translations;

    abstract public function select($query_to_append, $expression);
    abstract public function leftJoin($query_to_append, $expression);
    abstract public function from($query_to_append, $expression);
    abstract public function groupBy($query_to_append, $expression);

    public function __construct(array $translations = [])
    {
        $this->translations = $translations;
    }

    protected function translate($expression)
    {
        if (array_key_exists($expression, $this->translations)) {
            $expression = $this->translations[$expression];
        }
        return $expression;
    }
}
