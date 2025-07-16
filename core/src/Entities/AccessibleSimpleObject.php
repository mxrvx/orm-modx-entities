<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;

abstract class AccessibleSimpleObject extends AccessibleObject
{
    #[Column(type: 'primary', typecast: 'int', unsigned: true)]
    public int $id;
}

/**
 * <object class="modAccessibleSimpleObject" extends="modAccessibleObject">
 * <field key="id" dbtype="int" precision="10" attributes="unsigned" phptype="integer" null="false" index="pk" generated="native" />
 *
 * <index alias="PRIMARY" name="PRIMARY" primary="true" unique="true" type="BTREE">
 * <column key="id" length="" collation="A" null="false" />
 * </index>
 * </object>
 */
