<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

class PluginTextBlockEntity extends AbstractPluginBlockEntity
{
    protected $perex;
    protected $body;
    protected $buttonTitle;
    protected $buttonShow;
    protected $buttonUrl;
    protected $buttonBlank;

    public function __construct(
        int $id,
        ?string $title,
        ?bool $showTitle,
        ?string $perex,
        ?string $body,
        ?string $buttonTitle,
        ?bool $buttonShow,
        ?string $buttonUrl,
        ?bool $buttonBlank,
    ) {
        parent::__construct($id, $title, $showTitle);

        $this->perex = $perex ?? '';
        $this->body = $body ?? '';
        $this->buttonTitle = $buttonTitle ?? '';
        $this->buttonShow = $buttonShow ?? true;
        $this->buttonUrl = $buttonUrl ?? '';
        $this->buttonBlank = $buttonBlank ?? false;
    }

    public function getPerex(): string
    {
        return $this->perex;
    }

    public function setPerex(string $perex): void
    {
        $this->perex = $perex;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getButtonTitle(): string
    {
        return $this->buttonTitle;
    }

    public function setButtonTitle(string $buttonTitle): void
    {
        $this->buttonTitle = $buttonTitle;
    }

    public function isButtonShow(): bool
    {
        return $this->buttonShow;
    }

    public function setButtonShow(bool $buttonShow): void
    {
        $this->buttonShow = $buttonShow;
    }

    public function getButtonUrl(): string
    {
        return $this->buttonUrl;
    }

    public function setButtonUrl(string $buttonUrl): void
    {
        $this->buttonUrl = $buttonUrl;
    }

    public function isButtonBlank(): bool
    {
        return $this->buttonBlank;
    }

    public function setButtonBlank(bool $buttonBlank): void
    {
        $this->buttonBlank = $buttonBlank;
    }

    public function getPluginPrefix(): string
    {
        return 'textBlock';
    }
}