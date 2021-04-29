<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Views;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

abstract class View
{
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
     * View constructor.
     */
    public function __construct()
    {
        $this->content = Content::make()->linebreak();
        $this->initialize();
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

        $this->content->prepend(PHP_EOL, '<!-- viewless start !-->');
        $this->content->add('<!-- viewless start !-->', PHP_EOL);

        $contents = $this->content->build();

        $baseData = [
            'baseUrl' => Admin::link(),
        ];

        return admin_view($this->template, [
            'data' => $data,
            'baseData' => $baseData,
            'contents' => $contents,
        ]);
    }
}