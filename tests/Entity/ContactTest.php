<?php

namespace App\Tests\Entity;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    public function testGettersAndSettersWork(): void
    {
        $contact = (new Contact())
            ->setFirstName('John')
            ->setName('Doe')
            ->setStatus('NEW');

        $this->assertSame('John', $contact->getFirstName());
        $this->assertSame('Doe', $contact->getName());
        $this->assertSame('NEW', $contact->getStatus());
    }
}
