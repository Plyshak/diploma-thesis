<?php declare(strict_types = 1);

namespace Domain\Content\Entity\Plugin;

class PluginPictureBlockEntity extends AbstractPluginBlockEntity
{
    public const PREFIX = 'pictureBlock';

    protected $image;
    protected $pictureDescription;
    protected $pictureAlign;
    protected $pictureShowDescription;
    protected $pictureWidth;

    public function __construct(
        int $id,
        ?string $title,
        ?bool $showTitle,
        ?string $image,
        ?string $pictureAlign,
        ?string $pictureDescription,
        ?bool $pictureShowDescription,
        ?string $pictureWidth
    ) {
        parent::__construct($id, $title, $showTitle);

        $this->image = $image ?? '';
        $this->pictureAlign = $pictureAlign ?? 'left';
        $this->pictureDescription = $pictureDescription ?? '';
        $this->pictureShowDescription = $pictureShowDescription ?? false;
        $this->pictureWidth = $pictureWidth ?? '250';
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPictureDescription(): string
    {
        return $this->pictureDescription;
    }

    public function getPictureAlign(): string
    {
        return $this->pictureAlign;
    }

    public function isPictureShowDescription(): bool
    {
        return $this->pictureShowDescription;
    }

    public function getPictureWidth(): string
    {
        return $this->pictureWidth;
    }

    public function getPluginPrefix(): string
    {
        return self::PREFIX;
    }
}