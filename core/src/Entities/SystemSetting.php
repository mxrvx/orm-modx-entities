<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(
    role: 'modx:SystemSetting',
    table: 'system_settings',
)]
class SystemSetting extends XObject
{
    #[Column(type: 'string(50)', primary: true, default: '', typecast: 'string')]
    public ?string $key;

    #[Column(type: 'text', typecast: 'string')]
    public string $value = '';

    #[Column(type: 'string(75)', default: 'textfield', typecast: 'string')]
    public string $xtype = 'textfield';

    #[Column(type: 'string(40)', default: 'core', typecast: 'string')]
    public string $namespace = 'core';

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public string $area = '';

    #[Column(type: 'timestamp', nullable: true, typecast: 'timestamp')]
    public ?string $editedon = null;

    /**
     * <code>
     * <aggregate alias="Namespace" class="modNamespace" local="namespace" foreign="name" cardinality="one" owner="foreign" />
     * </code>
     *
     */
    #[BelongsTo(target: Namespaces::class, innerKey: 'namespace', outerKey: 'name', nullable: true, fkCreate: false, indexCreate: false)]
    public ?Namespaces $Namespace = null;
}

/**
 * <object class="modSystemSetting" table="system_settings" extends="xPDOObject">
 * <field key="key" dbtype="varchar" precision="50" phptype="string" null="false" default="" index="pk" />
 * <field key="value" dbtype="text" phptype="string" null="false" default="" />
 * <field key="xtype" dbtype="varchar" precision="75" phptype="string" null="false" default="textfield" />
 * <field key="namespace" dbtype="varchar" precision="40" phptype="string" null="false" default="core" />
 * <field key="area" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="editedon" dbtype="timestamp" phptype="timestamp" null="true" default="NULL" attributes="ON UPDATE CURRENT_TIMESTAMP" />
 *
 * <index alias="PRIMARY" name="PRIMARY" primary="true" unique="true" type="BTREE">
 * <column key="key" length="" collation="A" null="false" />
 * </index>
 *
 * <aggregate alias="ContextSetting" class="modContextSetting" local="key" foreign="key" cardinality="one" owner="local" />
 * <aggregate alias="Namespace" class="modNamespace" local="namespace" foreign="name" cardinality="one" owner="foreign" />
 * </object>
 */
