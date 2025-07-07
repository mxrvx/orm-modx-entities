<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasMany;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(role: 'modx:Namespace', table: 'namespaces')]
class Namespaces extends AccessibleObject
{
    #[Column(type: 'string(40)', primary: true, typecast: 'string')]
    public string $name;

    #[Column(type: 'text', typecast: 'string', nullable: true)]
    public ?string $path = null;

    #[Column(type: 'text', typecast: 'string', nullable: true)]
    public ?string $assets_path = null;

    /**
     * <composite alias="SystemSettings" class="modSystemSetting" local="name" foreign="namespace" cardinality="many" owner="local" />
     */
    #[HasMany(target: SystemSetting::class, innerKey: 'name', outerKey: 'namespace', fkCreate: false, indexCreate: false)]
    public ?array $SystemSettings = null;
}

/**
 * <object class="modNamespace" table="namespaces" extends="modAccessibleObject">
 * <!-- A lowercase namespace name that this Namespace will be referred as -->
 * <field key="name" dbtype="varchar" precision="40" phptype="string" null="false" default="" index="pk" />
 * <!-- The core path of the Namespace, where the PHP files will reside -->
 * <field key="path" dbtype="text" phptype="string" default="" />
 * <!-- The assets path of the Namespace, where images/css/js and any public-facing files will reside -->
 * <field key="assets_path" dbtype="text" phptype="string" default="" />
 *
 * <index alias="PRIMARY" name="PRIMARY" primary="true" unique="true" type="BTREE">
 * <column key="name" length="" collation="A" null="false" />
 * </index>
 *
 * <composite alias="LexiconEntries" class="modLexiconEntry" local="name" foreign="namespace" cardinality="many" owner="local" />
 * <composite alias="SystemSettings" class="modSystemSetting" local="name" foreign="namespace" cardinality="many" owner="local" />
 * <composite alias="ContextSettings" class="modContextSetting" local="name" foreign="namespace" cardinality="many" owner="local" />
 * <composite alias="UserSettings" class="modUserSetting" local="name" foreign="namespace" cardinality="many" owner="local" />
 * <composite alias="ExtensionPackages" class="modExtensionPackage" local="name" foreign="namespace" cardinality="many" owner="local" />
 * <composite alias="Acls" class="modAccessNamespace" local="name" foreign="target" owner="local" cardinality="many" />
 *
 * <!-- @deprecated to be removed in 2.4/3.0 -->
 * <composite alias="Actions" class="modAction" local="name" foreign="namespace" cardinality="many" owner="local" />
 * </object>
 */
