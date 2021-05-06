<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Views;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Http\Support\ControllerParser;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

abstract class View
{
    use ControllerParser;

    /**
     * The view template.
     *
     * @var string
     */
    protected $template = '';

    /**
     * The view Content instance.
     *
     * @var Content
     */
    protected $content;

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var array
     */
    protected $configs = [];

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->content = Content::make()->linebreak();
        $this->config = new Repository($this->configs);

        $this->initialize();
    }

    /**
     * Set/get configuration value or get the configuration repository instance.
     *
     * @param string|array|null $key
     * @param mixed|null $value
     *
     * @return $this|Repository|mixed
     */
    public function config($key = null, $value = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        if (is_string($key)) {
            return $this->config->get($key, $value);
        }

        if (is_array($key)) {
            $this->config->set($key);
            return $this;
        }

        return $this->config;
    }

    /**
     * Get all configuration.
     *
     * @return array
     */
    public function configs(): array
    {
        return $this->config->all();
    }

    /**
     * Initialize view.
     */
    protected function initialize(): void
    {
    }

    /**
     * Ready to build view.
     */
    protected function ready(): void
    {
    }

    /**
     * @param array $data
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render(array $data = [])
    {
        $this->ready();

        $this->content->prepend(PHP_EOL, '<!-- viewless start !-->', PHP_EOL);
        $this->content->add(PHP_EOL, '<!-- viewless end !-->', PHP_EOL);

        $contents = $this->content->build();

        $baseData = [
            'baseUrl' => Admin::link(),
            'controllerName' => $this->controllerName(),
        ];

        return admin_view($this->template, [
            'data' => $data,
            'baseData' => $baseData,
            'configs' => $this->configs(),
            'contents' => $contents,
        ]);
    }
}