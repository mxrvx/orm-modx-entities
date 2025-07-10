<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Table\Index;
use MXRVX\ORM\Typecast;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(
    role: 'modx:Snippet',
    table: 'site_snippets',
    typecast: [\Cycle\ORM\Parser\Typecast::class, Typecast\TypecastHandler::class],
)]
#[Index(columns: ['locked'], name: 'locked')]
#[Index(columns: ['moduleguid'], name: 'moduleguid')]
#[Index(columns: ['static'], name: 'static')]
class Snippet extends Script
{
    #[Column(type: 'boolean', typecast: 'bool', default: false)]
    public bool $cache_type = false;

    #[Column(type: 'mediumText', typecast: 'string', nullable: true)]
    public ?string $snippet = null;

    #[Column(type: 'boolean', typecast: 'bool', default: false)]
    public bool $locked = false;

    #[Column(type: 'text', nullable: true)]
    #[Typecast\Types\Array\ArrayToSerializedString]
    public ?array $properties = null;

    #[Column(type: 'string(32)', typecast: 'string', default: '')]
    public string $moduleguid = '';

    #[Column(type: 'boolean', typecast: 'bool', default: false)]
    public bool $static = false;

    #[Column(type: 'string(191)', typecast: 'string', default: '')]
    public string $static_file = '';
}

/**
 * <object class="modSnippet" table="site_snippets" extends="modScript">
 * <field key="cache_type" dbtype="tinyint" precision="1" phptype="integer" null="false" default="0" />
 * <field key="snippet" dbtype="mediumtext" phptype="string" />
 * <field key="locked" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" index="index" />
 * <field key="properties" dbtype="text" phptype="array" null="true" />
 * <field key="moduleguid" dbtype="varchar" precision="32" phptype="string" null="false" default="" index="fk" />
 * <field key="static" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" index="index" />
 * <field key="static_file" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 *
 * <alias key="content" field="snippet" />
 *
 * <index alias="locked" name="locked" primary="false" unique="false" type="BTREE">
 * <column key="locked" length="" collation="A" null="false" />
 * </index>
 * <index alias="moduleguid" name="moduleguid" primary="false" unique="false" type="BTREE">
 * <column key="moduleguid" length="" collation="A" null="false" />
 * </index>
 * <index alias="static" name="static" primary="false" unique="false" type="BTREE">
 * <column key="static" length="" collation="A" null="false" />
 * </index>
 *
 * <composite alias="PropertySets" class="modElementPropertySet" local="id" foreign="element" owner="local" cardinality="many">
 * <criteria target="foreign"><![CDATA[
 * {"element_class":"modSnippet"}
 * ]]></criteria>
 * </composite>
 * </object>
 */
