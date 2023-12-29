<?php

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;

describe('Config path assembly exceptions', function () {
    it('throws a MissingPathNamespaceKeyException when a key has no path or namespace', function () {
        Config::set('laraca.struct.empty_key', []);
        Config::set('laraca.struct.command.parent', 'empty_key');

        assembleFullPath('command');

    })->with('classes')->throws(MissingPathNamespaceKeyException::class);

    it('throws an InvalidConfigKeyException when an initial key does not exist in the config', function () {

        assembleFullPath('not_a_real_key');

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('throws an InvalidConfigKeyException when a parent key does not exist in the config', function () {
        Config::set('laraca.struct.model.parent', 'nonexistent_key');

        assembleFullPath('model');

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('throws a MissingRootPathException when a tree does not lead to a base or app parent', function () {
        Config::set('laraca.struct.model.parent', '');

        assembleFullPath('model');

    })->with('classes')->throws(MissingRootPathException::class);
});
