<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\Annotated\Annotation\Relation\HasMany;
use Cycle\Annotated\Annotation\Table\Index;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(role: 'modx:Category', table: 'categories')]
#[Index(columns: ['parent'], name: 'parent')]
#[Index(columns: ['parent', 'category'], unique: true, name: 'category')]
#[Index(columns: ['rank'], name: 'rank')]
class Category extends AccessibleSimpleObject
{
    #[Column(type: 'int', unsigned: true, typecast: 'int')]
    public int $parent;

    #[Column(type: 'string(45)', typecast: 'string', default: '')]
    public string $category = '';

    #[Column(type: 'integer(11)', default: 0, typecast: 'int')]
    public int $rank = 0;

    /**
     * <composite alias="Children" class="modCategory" local="id" foreign="parent" cardinality="many" owner="local" />
     */
    #[HasMany(target: Category::class, innerKey: 'id', outerKey: 'parent', fkCreate: false, indexCreate: false)]
    public ?array $Childrens = null;

    /**
     * <aggregate alias="Parent" class="modCategory" local="parent" foreign="id" cardinality="one" owner="foreign" />
     */
    #[BelongsTo(target: Category::class, innerKey: 'parent', outerKey: 'id', nullable: true, fkCreate: false, indexCreate: false, )]
    public ?Category $Parent = null;
}

/**
 * <object class="modCategory" table="categories" extends="modAccessibleSimpleObject">
 * <field key="parent" dbtype="int" precision="10" phptype="integer" attributes="unsigned" default="0" index="unique" indexgrp="category" />
 * <field key="category" dbtype="varchar" precision="45" phptype="string" null="false" default="" index="unique" indexgrp="category" />
 * <field key="rank" dbtype="int" precision="11" phptype="integer" null="false" default="0" index="index" />
 *
 * <index alias="parent" name="parent" primary="false" unique="false" type="BTREE">
 * <column key="parent" length="" collation="A" null="false" />
 * </index>
 * <index alias="category" name="category" primary="false" unique="true" type="BTREE">
 * <column key="parent" length="" collation="A" null="false" />
 * <column key="category" length="" collation="A" null="false" />
 * </index>
 * <index alias="rank" name="rank" primary="false" unique="false" type="BTREE">
 * <column key="rank" length="" collation="A" null="false" />
 * </index>
 *
 * <composite alias="Children" class="modCategory" local="id" foreign="parent" cardinality="many" owner="local" />
 * <aggregate alias="Parent" class="modCategory" local="parent" foreign="id" cardinality="one" owner="foreign" />
 *
 * <aggregate alias="Chunks" class="modChunk" key="id" local="id" foreign="category" cardinality="many" owner="local" />
 * <aggregate alias="Snippets" class="modSnippet" local="id" foreign="category" cardinality="many" owner="local" />
 * <aggregate alias="Plugins" class="modPlugin" local="id" foreign="category" cardinality="many" owner="local" />
 * <aggregate alias="Templates" class="modTemplate" local="id" foreign="category" cardinality="many" owner="local" />
 * <aggregate alias="TemplateVars" class="modTemplateVar" local="id" foreign="category" cardinality="many" owner="local" />
 * <aggregate alias="PropertySets" class="modPropertySet" local="id" foreign="category" cardinality="many" owner="local" />
 * <composite alias="Acls" class="modAccessCategory" local="id" foreign="target" owner="local" cardinality="many" />
 *
 * <composite alias="Ancestors" class="modCategoryClosure" local="id" foreign="ancestor" cardinality="many" owner="local" />
 * <composite alias="Descendants" class="modCategoryClosure" local="id" foreign="descendant" cardinality="many" owner="local" />
 * </object>
 */
