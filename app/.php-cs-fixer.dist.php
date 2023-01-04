<?php

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,

        // Force strict types declaration in all files. Requires PHP >= 7.0.
        'declare_strict_types' => true,
        // All classes must be final, except abstract ones and Doctrine entities.
        'final_class' => true,
        // Add leading `\` before constant invocation of internal constant to speed up resolving. Constant name match is case-sensitive, except for `null`, `false` and `true`.
        'native_constant_invocation' => true,
        // Function defined by PHP should be called using the correct casing.
        'native_function_casing' => true,
        // Add leading `\` before function invocation to speed up resolving.
        'native_function_invocation' => ['include' => ['@all']],
        // Native type hints for functions should use the correct case.
        'native_function_type_declaration_casing' => true,
        // Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line.
        'blank_line_after_opening_tag' => false,
        // Ensure there is no code on the same line as the PHP open tag.
        'linebreak_after_opening_tag' => false,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude(['vendor', 'var', 'public', 'config'])
            ->in(__DIR__)
    );
