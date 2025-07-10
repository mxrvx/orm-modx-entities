<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\Annotated\Annotation\Table\Index;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Index(columns: ['name'], unique: true, name: 'name')]
#[Index(columns: ['category'], name: 'category')]
abstract class Script extends Element
{
    #[Column(type: 'string(50)', typecast: 'string')]
    public string $name;

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public string $description = '';

    #[Column(type: 'int', default: 0, typecast: 'int')]
    public int $editor_type = 0;

    #[Column(type: 'int', default: 0, typecast: 'int')]
    public int $category = 0;

    /**
     * <code>
     * <aggregate alias="Category" class="modCategory" local="category" foreign="id" cardinality="one" owner="foreign" />
     * </code>
     *
     */
    #[BelongsTo(target: Category::class, innerKey: 'category', outerKey: 'id', nullable: true, fkCreate: false, indexCreate: false, )]
    public ?Category $Category = null;
}

/**
 * <object class="modScript" table="site_script" extends="modElement">
 * <field key="name" dbtype="varchar" precision="50" phptype="string" null="false" default="" index="unique" />
 * <field key="description" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="editor_type" dbtype="int" precision="11" phptype="integer" null="false" default="0" />
 * <field key="category" dbtype="int" precision="11" phptype="integer" null="false" default="0" index="fk" />
 *
 * <index alias="name" name="name" primary="false" unique="true" type="BTREE">
 * <column key="name" length="" collation="A" null="false" />
 * </index>
 * <index alias="category" name="category" primary="false" unique="false" type="BTREE">
 * <column key="category" length="" collation="A" null="false" />
 * </index>
 *
 * <aggregate alias="Category" class="modCategory" key="id" local="category" foreign="id" cardinality="one" owner="foreign" />
 * </object>
 */
