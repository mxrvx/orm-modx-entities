<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Relation\BelongsTo;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
abstract class Element extends AccessibleSimpleObject
{
    #[Column(type: 'int', typecast: 'int', unsigned: true)]
    public int $source = 0;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $property_preprocess = false;

    /**
     * <code>
     * <aggregate alias="Source" class="sources.modMediaSource" local="source" foreign="id" owner="foreign" cardinality="one" />
     * </code>
     *
     */
    #[BelongsTo(target: MediaSource::class, innerKey: 'source', outerKey: 'id', nullable: true, fkCreate: false, indexCreate: false)]
    public ?MediaSource $Source = null;
}

/**
 * <object class="modElement" table="site_element" extends="modAccessibleSimpleObject">
 * <field key="source" dbtype="int" attributes="unsigned" phptype="integer" null="false" default="0" index="fk" />
 * <field key="property_preprocess" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" />
 *
 * <composite alias="Acls" class="modAccessElement" local="id" foreign="target" owner="local" cardinality="many" />
 * <aggregate alias="CategoryAcls" class="modAccessCategory" local="category" foreign="target" owner="local" cardinality="many" />
 * <aggregate alias="Source" class="sources.modMediaSource" local="source" foreign="id" owner="foreign" cardinality="one" />
 * </object>
 */
