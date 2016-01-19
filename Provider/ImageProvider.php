<?php

namespace Opifer\MediaBundle\Provider;

use Opifer\MediaBundle\Model\MediaInterface;

/**
 * Extends FileProvider to add image-specific functionality.
 */
class ImageProvider extends FileProvider
{
    /**
     * {@inheritdoc}
     */
    public function getThumb(MediaInterface $media)
    {
        return $media->getReference();
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->translator->trans('image.label');
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(MediaInterface $media)
    {
        if (is_null($file = $media->getFile())) {
            return;
        }

        parent::prePersist($media);

        $size = getimagesize($file);
        $media->setMetadata(['width' => $size[0], 'height' => $size[1]]);
    }
}
