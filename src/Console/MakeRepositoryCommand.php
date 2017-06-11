<?php

namespace Socialchan\Hikari\Console;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
	/**
     * The console command name.
     *
     * @var string
     */
	protected $name = 'make:repository';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new repository class';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Repository';

	/**
	 * Parse the name and format according to the root namespace.
	 *
	 * @param string $name
	 * 
	 * @return string
	 */
	protected function parseName($name)
	{
		return studly_case($name) . 'Repository';
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return __DIR__ . '/stubs/repository.stub';
	}

	/**
	 * Build the class with the given name.
	 *
	 * @param string $name
	 * 
	 * @return string
	 */
	protected function buildClass($name = null)
	{
		$stub = $this->files->get($this->getStub());

		return $this->replaceClass($stub, $name);
	}

	/**
	 * Replace the class name for the given stub.
	 *
	 * @param string $stub
	 * @param string $name
	 * 
	 * @return string
	 */
	protected function replaceClass($stub, $name)
	{
		$stub = str_replace('{{class}}', $name, $stub);

		return $stub;
	}

	/**
	 * Get the destination class path.
	 *
	 * @param string $name
	 * 
	 * @return string
	 */
	protected function getPath($name)
	{
		return app_path() . '/Repositories/' . str_replace('\\', '/', $name) . '.php';
	}
}
