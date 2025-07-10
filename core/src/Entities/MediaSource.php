<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasMany;
use Cycle\Annotated\Annotation\Table\Index;
use MXRVX\ORM\Typecast;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */

#[Entity(
    role: 'modx:MediaSource',
    table: 'media_sources',
    typecast: [\Cycle\ORM\Parser\Typecast::class, Typecast\TypecastHandler::class],
)]
#[Index(columns: ['name'], name: 'name')]
#[Index(columns: ['class_key'], name: 'class_key')]
#[Index(columns: ['is_stream'], name: 'is_stream')]
class MediaSource extends AccessibleSimpleObject
{
    #[Column(type: 'string(191)', typecast: 'string', nullable: false)]
    public string $name;

    #[Column(type: 'text', typecast: 'string', nullable: true)]
    public ?string $description = null;

    #[Column(type: 'string(100)', typecast: 'string', nullable: false, default: 'sources.modFileMediaSource')]
    public string $class_key = 'sources.modFileMediaSource';

    #[Column(type: 'mediumText', nullable: true)]
    #[Typecast\Types\Array\ArrayToSerializedString]
    public ?array $properties = null;

    #[Column(type: 'boolean', typecast: 'bool', default: true)]
    public bool $is_stream;

    /**
     * <code>
     * <aggregate alias="Snippets" class="modSnippet" local="id" foreign="source" cardinality="many" owner="local" />
     * </code>
     *
     * @var null|Snippet[]
     */
    #[HasMany(target: Snippet::class, innerKey: 'id', outerKey: 'source', nullable: true, fkCreate: false, indexCreate: false)]
    public ?array $Snippets = null;

    public static function getDefaultProperties(): array
    {
        return [
            'basePath' => [
                'name' => 'basePath',
                'desc' => 'prop_file.basePath_desc',
                'type' => 'textfield',
                'options' => '',
                'value' => '',
                'lexicon' => 'core:source',
            ],
            'basePathRelative' => [
                'name' => 'basePathRelative',
                'desc' => 'prop_file.basePathRelative_desc',
                'type' => 'combo-boolean',
                'options' => '',
                'value' => true,
                'lexicon' => 'core:source',
            ],
            'baseUrl' => [
                'name' => 'baseUrl',
                'desc' => 'prop_file.baseUrl_desc',
                'type' => 'textfield',
                'options' => '',
                'value' => '',
                'lexicon' => 'core:source',
            ],
            'baseUrlRelative' => [
                'name' => 'baseUrlRelative',
                'desc' => 'prop_file.baseUrlRelative_desc',
                'type' => 'combo-boolean',
                'options' => '',
                'value' => true,
                'lexicon' => 'core:source',
            ],
            'allowedFileTypes' => [
                'name' => 'allowedFileTypes',
                'desc' => 'prop_file.allowedFileTypes_desc',
                'type' => 'textfield',
                'options' => '',
                'value' => '',
                'lexicon' => 'core:source',
            ],
            'imageExtensions' => [
                'name' => 'imageExtensions',
                'desc' => 'prop_file.imageExtensions_desc',
                'type' => 'textfield',
                'value' => 'jpg,jpeg,png,gif,svg',
                'lexicon' => 'core:source',
            ],
            'thumbnailType' => [
                'name' => 'thumbnailType',
                'desc' => 'prop_file.thumbnailType_desc',
                'type' => 'list',
                'options' => [
                    ['name' => 'PNG', 'value' => 'png'],
                    ['name' => 'JPG', 'value' => 'jpg'],
                    ['name' => 'GIF', 'value' => 'gif'],
                ],
                'value' => 'png',
                'lexicon' => 'core:source',
            ],
            'thumbnailQuality' => [
                'name' => 'thumbnailQuality',
                'desc' => 'prop_s3.thumbnailQuality_desc',
                'type' => 'textfield',
                'options' => '',
                'value' => 90,
                'lexicon' => 'core:source',
            ],
            'visibility' => [
                'name' => 'visibility',
                'desc' => 'prop_file.visibility_desc',
                'type' => 'modx-combo-visibility',
                'options' => '',
                'value' => 'public',
                'lexicon' => 'core:source',
            ],
            'skipFiles' => [
                'name' => 'skipFiles',
                'desc' => 'prop_file.skipFiles_desc',
                'type' => 'textfield',
                'options' => '',
                'value' => '.svn,.git,_notes,nbproject,.idea,.DS_Store',
                'lexicon' => 'core:source',
            ],
        ];
    }
}

/**
 * <object class="modMediaSource" table="media_sources" extends="modAccessibleObject">
 * <field key="name" dbtype="varchar" precision="191" phptype="string" null="false" default="" index="index"/>
 * <field key="description" dbtype="text" phptype="string" null="true" />
 * <field key="class_key" dbtype="varchar" precision="100" phptype="string" null="false" default="sources.modFileMediaSource" index="index" />
 * <field key="properties" dbtype="mediumtext" phptype="array" null="true" />
 * <field key="is_stream" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="1" index="index" />
 *
 * <index alias="name" name="name" primary="false" unique="false" type="BTREE">
 * <column key="name" length="" collation="A" null="false" />
 * </index>
 * <index alias="class_key" name="class_key" primary="false" unique="false" type="BTREE">
 * <column key="class_key" length="" collation="A" null="false" />
 * </index>
 * <index alias="is_stream" name="is_stream" primary="false" unique="false" type="BTREE">
 * <column key="is_stream" length="" collation="A" null="false" />
 * </index>
 *
 * <composite alias="SourceElement" class="sources.modMediaSourceElement" local="id" foreign="source" cardinality="one" owner="local" />
 * <aggregate alias="Chunks" class="modChunk" local="id" foreign="source" cardinality="many" owner="local" />
 * <aggregate alias="Plugins" class="modPlugin" local="id" foreign="source" cardinality="many" owner="local" />
 * <aggregate alias="Snippets" class="modSnippet" local="id" foreign="source" cardinality="many" owner="local" />
 * <aggregate alias="Templates" class="modTemplate" local="id" foreign="source" cardinality="many" owner="local" />
 * <aggregate alias="TemplateVars" class="modTemplateVar" local="id" foreign="source" cardinality="many" owner="local" />
 * </object>
 */
