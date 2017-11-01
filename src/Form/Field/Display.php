<?php

namespace Jblv\Admin\Form\Field;

use Closure;
use Jblv\Admin\Form\Field;

class Display extends Field
{
    protected $callback;

    /**
     * @deprecated
     *
     * @param Closure $callback
     */
    public function format(Closure $callback)
    {
        $this->with($callback);
    }

    public function with(Closure $callback)
    {
        $this->callback = $callback;
    }

    public function render()
    {
        if ($this->callback instanceof Closure) {
            $this->value = $this->callback->call($this->form->model(), $this->value);
        }

        return parent::render();
    }
}
