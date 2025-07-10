<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(
    role: 'modx:ContextSetting',
    table: 'context_setting',
)]
class ContextSetting extends XObject
{
    #[Column(type: 'string(191)', primary: true, typecast: 'string')]
    public string $context_key;

    #[Column(type: 'string(50)', primary: true, typecast: 'string')]
    public string $key;

    #[Column(type: 'mediumtext', nullable: true, typecast: 'string')]
    public ?string $value = null;

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
     * <aggregate alias="Context" class="modContext" key="context_key" local="context_key" foreign="key" cardinality="one" owner="foreign" />
     * </code>
     *
     */
    #[BelongsTo(target: Context::class, innerKey: 'context_key', outerKey: 'key', fkCreate: false, indexCreate: false)]
    public Context $Context;

    /**
     * <code>
     * <aggregate alias="SystemSetting" class="modSystemSetting" key="key" local="key" foreign="key" cardinality="one" owner="foreign" />
     * </code>
     *
     */
    #[BelongsTo(target: SystemSetting::class, innerKey: 'key', outerKey: 'key', fkCreate: false, indexCreate: false)]
    public SystemSetting $SystemSetting;
}

/**
 * <object class="modContextSetting" table="context_setting" extends="xPDOObject">
 * <field key="context_key" dbtype="varchar" precision="191" phptype="string" null="false" index="pk" />
 * <field key="key" dbtype="varchar" precision="50" phptype="string" null="false" index="pk" />
 * <field key="value" dbtype="mediumtext" phptype="string" />
 * <field key="xtype" dbtype="varchar" precision="75" phptype="string" null="false" default="textfield" />
 * <field key="namespace" dbtype="varchar" precision="40" phptype="string" null="false" default="core" />
 * <field key="area" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="editedon" dbtype="timestamp" phptype="timestamp" null="true" default="NULL" attributes="ON UPDATE CURRENT_TIMESTAMP" />
 *
 * <index alias="PRIMARY" name="PRIMARY" primary="true" unique="true">
 * <column key="context_key" collation="A" null="false" />
 * <column key="key" collation="A" null="false" />
 * </index>
 *
 * <aggregate alias="Context" class="modContext" key="context_key" local="context_key" foreign="key" cardinality="one" owner="foreign" />
 * <aggregate alias="SystemSetting" class="modSystemSetting" key="key" local="key" foreign="key" cardinality="one" owner="foreign" />
 * </object>
 */
