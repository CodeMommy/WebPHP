<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Script;

use DOMDocument;

/**
 * Class RemoveRule
 * @package CodeMommy\Script;
 */
class RemoveRule
{
    /**
     * RemoveRule constructor.
     */
    public function __construct()
    {
    }

    /**
     * Get Rule To Delete
     * @return array
     */
    private static function getRuleToDelete()
    {
        return array(
            'cleancode' => array(
                'StaticAccess'
            )
        );
    }

    /**
     * Start
     */
    public static function start()
    {
        $ruleToDelete = self::getRuleToDelete();
        foreach ($ruleToDelete as $fileName => $ruleName) {
            $file = sprintf('vendor/phpmd/phpmd/src/main/resources/rulesets/%s.xml', $fileName);
            $ruleDocument = new DOMDocument();
            $ruleDocument->load($file);
            $ruleSet = $ruleDocument->getElementsByTagName('rule');
            foreach ($ruleSet as $rule) {
                foreach ($rule->attributes as $attribute) {
                    if ($attribute->nodeName == 'name' && in_array($attribute->nodeValue, $ruleName)) {
                        $rule->parentNode->removeChild($rule);
                    }
                }
            }
            $ruleDocument->save($file);
        }
    }
}
