<?php

/*
 * This file is part of OBOOM PHP Client.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Oboom\API;

use BrianFaust\Http\HttpResponse;

class Upload extends AbstractAPI
{
    protected $endpoint = 'upload';

    public function import($items, $target, $new_name, $name_policy = 'fail', $revision = null): HttpResponse
    {
        return $this->client->post('import', compact('items', 'target', 'new_name', 'name_policy', 'revision'));
    }

    public function touch($name, $parent, $name_policy = 'fail', $revision = null): HttpResponse
    {
        return $this->client->post('touch', compact('name', 'parent', 'name_policy', 'revision'));
    }

    public function dupe($sha1, $size, $name, $parent, $name_policy, $revision): HttpResponse
    {
        return $this->client->post('dupe', compact('sha1', 'size', 'name', 'parent', 'name_policy', 'revision'));
    }

    public function file($token, $file, $parent, $name_policy = 'fail'): HttpResponse
    {
        return $this->client->asMultipart()->post(
            'ul', compact('token', 'parent', 'name_policy') + ['file' => fopen($file, 'r')]
        );
    }
}
