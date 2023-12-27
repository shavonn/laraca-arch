<?php

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;

describe('assemble Path, Namespace exceptions', function () {
    it('throws a MissingPathNamespaceKeyException when a key has no path or namespace', function () {
        Config::set('laraca.empty_key', []);
        Config::set('laraca.command.parent', 'empty_key');

        assembleNamespace('command');

    })->with('classes')->throws(MissingPathNamespaceKeyException::class);

    it('throws an InvalidConfigKeyException when an initial key does not exist in the config', function () {

        assemblePath('not_a_real_key');

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('throws an InvalidConfigKeyException when a parent key does not exist in the config', function () {
        Config::set('laraca.model.parent', 'nonexistent_key');

        assembleNamespace('model');

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('throws a MissingRootPathException when a tree does not lead to a base or app parent', function () {
        Config::set('laraca.model.parent', '');

        assembleNamespace('model');

    })->with('classes')->throws(MissingRootPathException::class);
});
