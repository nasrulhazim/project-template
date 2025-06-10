<?php

namespace App\Actions\Builder;

use CleaniqueCoders\Traitify\Contracts\Builder;
use InvalidArgumentException;

/**
 * Class MenuItem
 *
 * Represents a menu item with configurable attributes, visibility, and nested children.
 */
class MenuItem implements Builder
{
    private string $label;

    private string $url;

    private string $target = '_self';

    private array $attributes = [];

    /** @var array<MenuItem> */
    private array $children = [];

    private string $icon = 'o-squares-2x2';

    private ?string $description = null;

    private ?string $tooltip = null;

    private string $type = 'link'; // 'link' or 'form'

    /** @var array<string, mixed> */
    private array $formAttributes = []; // Attributes specific to forms

    /** @var callable|bool */
    private $visible = true;

    /** @var array<string, mixed> */
    private array $output = [];

    /**
     * Set the label for the menu item.
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the URL for the menu item.
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the target for the menu item.
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Add an attribute to the menu item.
     */
    public function addAttribute(string $key, string $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Add a child menu item.
     */
    public function addChild(MenuItem $child): self
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Set the icon for the menu item.
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the description for the menu item.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the tooltip for the menu item.
     */
    public function setTooltip(string $tooltip): self
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    /**
     * Set the visibility for the menu item.
     *
     * @param  callable|bool  $visible
     */
    public function setVisible($visible): self
    {
        if (! is_bool($visible) && ! is_callable($visible)) {
            throw new InvalidArgumentException('The visible property must be a boolean or a callable.');
        }

        $this->visible = $visible;

        return $this;
    }

    /**
     * Set the type of the menu item.
     */
    public function setType(string $type): self
    {
        if (! in_array($type, ['link', 'form'], true)) {
            throw new InvalidArgumentException('The type must be "link" or "form".');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Add form-specific attributes.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function setFormAttributes(array $attributes): self
    {
        $this->formAttributes = $attributes;

        return $this;
    }

    /**
     * Determine if the menu item is visible.
     */
    public function isVisible(): bool
    {
        return is_callable($this->visible) ? call_user_func($this->visible) : $this->visible;
    }

    /**
     * Build and construct the menu item output.
     */
    public function build(): self
    {
        $this->output = [
            'label' => $this->label,
            'url' => $this->url,
            'active' => $this->url == request()->url(),
            'target' => $this->target,
            'attributes' => $this->attributes,
            'icon' => $this->icon,
            'description' => $this->description,
            'tooltip' => $this->tooltip,
            'type' => $this->type,
            'formAttributes' => $this->type === 'form' ? $this->formAttributes : [],
            'children' => array_filter(
                array_map(fn (MenuItem $child) => $child->build()->toArray(), $this->children),
                fn (array $child) => $child !== [] // Exclude hidden children
            ),
        ];

        return $this;
    }

    /**
     * Get the menu item as an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->output;
    }

    /**
     * Get the menu item as JSON.
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options, 512);
    }
}
