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
    role: 'modx:Session',
    table: 'session',
)]
#[Index(columns: ['access'], name: 'access')]
class Session extends XObject
{
    #[Column(type: 'string(191)', primary: true, typecast: 'string')]
    public string $id;

    #[Column(type: 'integer(20)', default: null, typecast: 'timestamp', unsigned: true)]
    public ?int $access = null;

    #[Column(type: 'mediumText', nullable: true, default: null, typecast: 'string')]
    public ?string $data = null;
}

/**
 * <object class="modSession" table="session" extends="xPDO\Om\xPDOObject">
 * <field key="id" dbtype="varchar" precision="191" phptype="string" null="false" index="pk" default="" />
 * <field key="access" dbtype="int" precision="20" phptype="timestamp" null="false" attributes="unsigned" />
 * <field key="data" dbtype="mediumtext" phptype="string" />
 *
 * <index alias="PRIMARY" name="PRIMARY" primary="true" unique="true" type="BTREE">
 * <column key="id" length="" collation="A" null="false" />
 * </index>
 * <index alias="access" name="access" primary="false" unique="false" type="BTREE">
 * <column key="access" length="" collation="A" null="false" />
 * </index>
 *
 * </object>
 */
