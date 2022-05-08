<?php declare(strict_types = 1);

namespace Infrastructure\Exception;

class FileExtensionNotSupported extends AbstractInfrastructureException
{
    public function __construct(string $extension, array $supportedExtensions)
    {
        parent::__construct(
            sprintf(
                'File extension "%s" not supported. Try using one of supported file type: "%s".',
                $extension,
                implode(', ', $supportedExtensions)
            ),
            415
        );
    }
}