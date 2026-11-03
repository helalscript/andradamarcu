<?php

/*
 * This file is part of the Dragonpay library.
 *
 * (c) Jefferson Claud <jeffclaud17@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Crazymeeks\Encryption;

use Crazymeeks\Contracts\DigestInterface;

class Sha1Encryption implements DigestInterface
{


	/**
	 * @inheritDoc
	 */
	public function make(array $data)
	{
		$digest = sha1(implode(':', $data));
		return $digest;
	}
}