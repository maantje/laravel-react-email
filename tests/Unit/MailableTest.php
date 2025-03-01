<?php

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Maantje\ReactEmail\Exceptions\NodeNotFoundException;
use Maantje\ReactEmail\ReactMailable;
use Maantje\ReactEmail\Renderer;
use Mockery\MockInterface;
use Symfony\Component\Process\ExecutableFinder;

it('renders the html and text from react-email', function () {
    (new TestMailable)
        ->assertSeeInHtml(
            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html dir="ltr" lang="en"><head></head><!--$--><p style="font-size:14px;line-height:24px;margin:16px 0">Hello from react email, <!-- -->test</p><!--/$--></html>',
            false,
    )
        ->assertSeeInText('Hello from react email, test');
});

it('throws an exception if node executable is not resolved', function () {
    config()->set('react-email.node_path');

    $this->expectException(NodeNotFoundException::class);

    $this->instance(
        ExecutableFinder::class,
        Mockery::mock(ExecutableFinder::class, function (MockInterface $mock) {
            $mock->shouldReceive('find')->andReturn(null);
        })
    );

    (new TestMailable)->render();
});

it('prioritises configuration value over executable finder', function () {
    config()->set('react-email.node_path', '/path/to/node');

    expect(Renderer::resolveNodeExecutable())->toEqual('/path/to/node');
});

class TestMailable extends ReactMailable
{
    public function __construct(public array $user = ['name' => 'test']) { }
    public function content()
    {
        return new Content('new-user');
    }
}
