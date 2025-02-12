<?php

namespace VanDeWeijer\OneSignal\Test;

use Illuminate\Support\Arr;
use VanDeWeijer\OneSignal\OneSignalButton;
use VanDeWeijer\OneSignal\OneSignalMessage;
use VanDeWeijer\OneSignal\OneSignalWebButton;

class MessageTest extends \PHPUnit\Framework\TestCase
{
    /** @var \VanDeWeijer\OneSignal\OneSignalMessage */
    protected $message;

    public function setUp(): void
    {
        parent::setUp();
        $this->message = new OneSignalMessage();
    }

    /** @test */
    public function it_can_accept_a_message_when_constructing_a_message()
    {
        $message = new OneSignalMessage('Message body');

        $this->assertEquals('Message body', Arr::get($message->toArray(), 'contents.en'));
    }

    /** @test */
    public function it_provides_a_create_method()
    {
        $message = OneSignalMessage::create('Message body');

        $this->assertEquals('Message body', Arr::get($message->toArray(), 'contents.en'));
    }

    /** @test */
    public function it_can_set_the_body()
    {
        $this->message->setBody('myBody');

        $this->assertEquals('myBody', Arr::get($this->message->toArray(), 'contents.en'));
    }

    /** @test */
    public function it_can_set_the_subject()
    {
        $this->message->setSubject('mySubject');

        $this->assertEquals('mySubject', Arr::get($this->message->toArray(), 'headings.en'));
    }

    /** @test */
    public function it_does_not_append_empty_subject_value_when_subject_is_null()
    {
        $this->assertEquals(null, Arr::get($this->message->toArray(), 'headings'));
    }

    /** @test */
    public function it_can_set_the_url()
    {
        $this->message->setUrl('myURL');

        $this->assertEquals('myURL', Arr::get($this->message->toArray(), 'url'));
    }

    /** @test */
    public function it_can_set_the_increment_badge_count()
    {
        $this->message->incrementIosBadgeCount(123);

        $this->assertEquals('Increase', Arr::get($this->message->toArray(), 'ios_badgeType'));
        $this->assertEquals(123, Arr::get($this->message->toArray(), 'ios_badgeCount'));
    }

    /** @test */
    public function it_can_set_the_decrement_badge_count()
    {
        $this->message->decrementIosBadgeCount(123);

        $this->assertEquals('Increase', Arr::get($this->message->toArray(), 'ios_badgeType'));
        $this->assertEquals(-123, Arr::get($this->message->toArray(), 'ios_badgeCount'));
    }

    /** @test */
    public function it_can_set_the_badge_count()
    {
        $this->message->setIosBadgeCount(123);

        $this->assertEquals('SetTo', Arr::get($this->message->toArray(), 'ios_badgeType'));
        $this->assertEquals(123, Arr::get($this->message->toArray(), 'ios_badgeCount'));
    }

    /** @test */
    public function it_can_set_additional_data()
    {
        $this->message->setData('key_one', 'value_one');
        $this->message->setData('key_two', 'value_two');

        $this->assertEquals('value_one', Arr::get($this->message->toArray(), 'data.key_one'));
        $this->assertEquals('value_two', Arr::get($this->message->toArray(), 'data.key_two'));
    }

    /** @test */
    public function it_can_set_additional_parameter()
    {
        $this->message->setParameter('key_one', 'value_one');
        $this->message->setParameter('key_two', 'value_two');

        $this->assertEquals('value_one', Arr::get($this->message->toArray(), 'key_one'));
        $this->assertEquals('value_two', Arr::get($this->message->toArray(), 'key_two'));
    }

    /** @test */
    public function it_can_set_the_icon()
    {
        $this->message->setIcon('myIcon');

        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'chrome_web_icon'));
        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'chrome_icon'));
        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'adm_small_icon'));
        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'small_icon'));
    }

    /** @test */
    public function it_can_set_a_web_button()
    {
        $this->message->webButton(
            OneSignalWebButton::create('buttonID')
                ->text('buttonText')
                ->url('buttonURL')
                ->icon('buttonIcon')
        );

        $this->assertEquals('buttonID', Arr::get($this->message->toArray(), 'web_buttons.0.id'));
        $this->assertEquals('buttonText', Arr::get($this->message->toArray(), 'web_buttons.0.text'));
        $this->assertEquals('buttonURL', Arr::get($this->message->toArray(), 'web_buttons.0.url'));
        $this->assertEquals('buttonIcon', Arr::get($this->message->toArray(), 'web_buttons.0.icon'));
    }

    /** @test */
    public function it_can_set_a_button()
    {
        $this->message->setButton(
            OneSignalButton::create('buttonID')
                ->text('buttonText')
                ->icon('buttonIcon')
        );

        $this->assertEquals('buttonID', Arr::get($this->message->toArray(), 'buttons.0.id'));
        $this->assertEquals('buttonText', Arr::get($this->message->toArray(), 'buttons.0.text'));
        $this->assertEquals('buttonIcon', Arr::get($this->message->toArray(), 'buttons.0.icon'));
    }

    /** @test */
    public function it_can_set_a_web_buttons_with_chain()
    {
        $this->message->setWebButton(
            OneSignalWebButton::create('buttonID_1')
                ->text('buttonText_1')
                ->url('buttonURL_1')
                ->icon('buttonIcon_1')
        )->setWebButton(
            OneSignalWebButton::create('buttonID_2')
                ->text('buttonText_2')
                ->url('buttonURL_2')
                ->icon('buttonIcon_2')
        );

        $this->assertEquals('buttonID_1', Arr::get($this->message->toArray(), 'web_buttons.0.id'));
        $this->assertEquals('buttonText_1', Arr::get($this->message->toArray(), 'web_buttons.0.text'));
        $this->assertEquals('buttonURL_1', Arr::get($this->message->toArray(), 'web_buttons.0.url'));
        $this->assertEquals('buttonIcon_1', Arr::get($this->message->toArray(), 'web_buttons.0.icon'));
        $this->assertEquals('buttonID_2', Arr::get($this->message->toArray(), 'web_buttons.1.id'));
        $this->assertEquals('buttonText_2', Arr::get($this->message->toArray(), 'web_buttons.1.text'));
        $this->assertEquals('buttonURL_2', Arr::get($this->message->toArray(), 'web_buttons.1.url'));
        $this->assertEquals('buttonIcon_2', Arr::get($this->message->toArray(), 'web_buttons.1.icon'));
    }

    /** @test */
    public function it_can_set_a_image()
    {
        $this->message->setImageAttachments('https://url.com/to/image.jpg');

        $this->assertEquals('https://url.com/to/image.jpg', Arr::get($this->message->toArray(), 'ios_attachments.id1'));
        $this->assertEquals('https://url.com/to/image.jpg', Arr::get($this->message->toArray(), 'big_picture'));
        $this->assertEquals('https://url.com/to/image.jpg', Arr::get($this->message->toArray(), 'adm_big_picture'));
        $this->assertEquals('https://url.com/to/image.jpg', Arr::get($this->message->toArray(), 'chrome_big_picture'));
    }
}
