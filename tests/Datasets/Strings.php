<?php

declare(strict_types=1);

dataset('translatable-with-parameters', fn () => [
    [
        'Foo :attr1 bar :attr2: q :attr3 w :attr4 e :attr5.',
        'Foo {0} bar {1}: q {2} w {3} e {4}.',
        [':attr1', ':attr2', ':attr3', ':attr4', ':attr5'],
    ],
    [
        'Foo :attr1',
        'Foo {0}',
        [':attr1'],
    ],
    [
        'Foo bar',
        'Foo bar',
        [],
    ],
    [
        'Foo 123',
        'Foo 123',
        [],
    ],
    [
        1234,
        1234,
        [],
    ],
    [
        1234.56,
        1234.56,
        [],
    ],
]);

dataset('translatable-mixed-values', fn () => [
    ['Foo', 'Foo'],
    ['', ''],
    [' ', ' '],
    [123, 123],
    [123.45, 123.45],
    [null, null],
]);
