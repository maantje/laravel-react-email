<?php

namespace Maantje\ReactEmail;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class Renderer extends Process
{
    /**
     * @param string $view
     * @param array $data
     */
    private function __construct(string $view, array $data = [])
    {
        parent::__construct([
            (new ExecutableFinder())->find('node'),
            base_path('/node_modules/.bin/tsx'),
            __DIR__ .'/../render.tsx',
            config('react-email.template_directory') . $view,
            json_encode($data)
        ], base_path());
    }

    /**
     * Calls the react-email render
     *
     * @param string $view name of the file the component is in
     * @param array $data data that will be passed as props to the component
     * @return array
     */
    public static function render(string $view, array $data): array
    {
        $process = new self($view, $data);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return json_decode($process->getOutput(), true);
    }
}
