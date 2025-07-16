<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Table\Index;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(
    role: 'modx:Context',
    table: 'context',
)]
#[Index(columns: ['name'], name: 'name')]
#[Index(columns: ['rank'], name: 'rank')]
class Context extends AccessibleObject
{
    #[Column(type: 'string(100)', primary: true, typecast: 'string')]
    public string $key;

    #[Column(type: 'string(191)', nullable: true, typecast: 'string')]
    public ?string $name = null;

    #[Column(type: 'tinyText', nullable: true, typecast: 'string')]
    public ?string $description = null;

    #[Column(type: 'integer(11)', default: 0, typecast: 'integer')]
    public int $rank = 0;
}

/**
 * <object class="modContext" table="context" extends="modAccessibleObject">
 * <field key="key" dbtype="varchar" precision="100" phptype="string" null="false" index="pk" />
 * <field key="name" dbtype="varchar" precision="191" phptype="string" index="index" />
 * <field key="description" dbtype="tinytext" phptype="string" />
 * <field key="rank" dbtype="int" precision="11" phptype="integer" null="false" default="0" index="index" />
 *
 * <index alias="PRIMARY" name="PRIMARY" primary="true" unique="true" type="BTREE">
 * <column key="key" length="" collation="A" null="false" />
 * </index>
 * <index alias="name" name="name" primary="false" unique="false" type="BTREE">
 * <column key="name" length="" collation="A" null="false" />
 * </index>
 * <index alias="rank" name="rank" primary="false" unique="false" type="BTREE">
 * <column key="rank" length="" collation="A" null="false" />
 * </index>
 *
 * <composite alias="ContextResources" class="modContextResource" local="key" foreign="context_key" cardinality="many" owner="local" />
 * <composite alias="ContextSettings" class="modContextSetting" local="key" foreign="context_key" cardinality="many" owner="local" />
 * <composite alias="SourceElements" class="sources.modMediaSourceElement" local="key" foreign="context_key" cardinality="many" owner="local" />
 * <composite alias="Acls" class="modAccessContext" local="key" foreign="target" owner="local" cardinality="many" />
 * </object>
 */
