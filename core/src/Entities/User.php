<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasOne;
use Cycle\Annotated\Annotation\Table\Index;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(role: 'modx:User', table: 'users')]
#[Index(columns: ['username'], name: 'username', unique: true)]
#[Index(columns: ['class_key'], name: 'class_key')]
#[Index(columns: ['remote_key'], name: 'remote_key')]
#[Index(columns: ['primary_group'], name: 'primary_group')]
class User extends Principal
{
    #[Column(type: 'string(100)', default: '', typecast: 'string')]
    public ?string $username = null;

    #[Column(type: 'string(255)', default: '', typecast: 'string')]
    public string $password = '';

    #[Column(type: 'string(255)', default: '', typecast: 'string')]
    public string $cachepwd = '';

    #[Column(type: 'string(100)', default: 'modUser', typecast: 'string')]
    public string $class_key = 'modUser';

    #[Column(type: 'boolean', typecast: 'bool', default: true)]
    public bool $active = true;

    #[Column(type: 'string(191)', typecast: 'string', nullable: true)]
    public ?string $remote_key = null;

    #[Column(type: 'text', typecast: 'array', nullable: true)]
    public ?array $remote_data = null;

    #[Column(type: 'string(100)', typecast: 'string', default: 'hashing.modNative')]
    public string $hash_class = 'hashing.modNative';

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public string $salt = '';

    #[Column(type: 'int(10)', typecast: 'int', unsigned: true)]
    public int $primary_group = 0;

    #[Column(type: 'text', typecast: 'array', nullable: true)]
    public ?array $session_stale = null;

    #[Column(type: 'boolean', typecast: 'bool', default: false)]
    public bool $sudo = false;

    #[Column(type: 'int(20)', typecast: 'timestamp', default: 0)]
    public int $createdon = 0;

    /**
     * <composite alias="Profile" class="modUserProfile" local="id" foreign="internalKey" cardinality="one" owner="local" />
     */
    #[HasOne(target: UserProfile::class, innerKey: 'id', outerKey: 'internalKey', nullable: true, fkCreate: false, indexCreate: false)]
    public ?UserProfile $Profile = null;
}

/**
 * <object class="modUser" table="users" extends="modPrincipal">
 * <field key="username" dbtype="varchar" precision="100" phptype="string" null="false" default="" index="unique" />
 * <field key="password" dbtype="varchar" precision="255" phptype="string" null="false" default="" />
 * <field key="cachepwd" dbtype="varchar" precision="255" phptype="string" null="false" default="" />
 * <field key="class_key" dbtype="varchar" precision="100" phptype="string" null="false" default="modUser" index="index" />
 * <field key="active" dbtype="tinyint" precision="1" phptype="boolean" attributes="unsigned" null="false" default="1" />
 * <field key="remote_key" dbtype="varchar" precision="191" phptype="string" null="true" index="index" />
 * <field key="remote_data" dbtype="text" phptype="json" null="true" />
 * <field key="hash_class" dbtype="varchar" precision="100" phptype="string" null="false" default="hashing.modNative" />
 * <field key="salt" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="primary_group" dbtype="int" precision="10" phptype="integer" attributes="unsigned" null="false" default="0" index="index" />
 * <field key="session_stale" dbtype="text" phptype="array" null="true" />
 * <field key="sudo" dbtype="tinyint" precision="1" phptype="boolean" attributes="unsigned" null="false" default="0" />
 * <field key="createdon" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" />
 *
 * <index alias="username" name="username" primary="false" unique="true" type="BTREE">
 * <column key="username" length="" collation="A" null="false" />
 * </index>
 * <index alias="class_key" name="class_key" primary="false" unique="false" type="BTREE">
 * <column key="class_key" length="" collation="A" null="false" />
 * </index>
 * <index alias="remote_key" name="remote_key" primary="false" unique="false" type="BTREE">
 * <column key="remote_key" length="" collation="A" null="false" />
 * </index>
 * <index alias="primary_group" name="primary_group" primary="false" unique="false" type="BTREE">
 * <column key="primary_group" length="" collation="A" null="false" />
 * </index>
 *
 * <aggregate alias="CreatedResources" class="modResource" local="id" foreign="createdby" cardinality="many" owner="local" />
 * <aggregate alias="EditedResources" class="modResource" local="id" foreign="editedby" cardinality="many" owner="local" />
 * <aggregate alias="DeletedResources" class="modResource" local="id" foreign="deletedby" cardinality="many" owner="local" />
 * <aggregate alias="PublishedResources" class="modResource" local="id" foreign="publishedby" cardinality="many" owner="local" />
 * <aggregate alias="SentMessages" class="modUserMessage" local="id" foreign="sender" cardinality="many" owner="local" />
 * <aggregate alias="ReceivedMessages" class="modUserMessage" local="id" foreign="recipient" cardinality="many" owner="local" />
 * <aggregate alias="PrimaryGroup" class="modUserGroup" local="primary_group" foreign="id" cardinality="one" owner="foreign" />
 * <composite alias="Profile" class="modUserProfile" local="id" foreign="internalKey" cardinality="one" owner="local" />
 * <composite alias="UserSettings" class="modUserSetting" local="id" foreign="user" cardinality="many" owner="local" />
 * <composite alias="UserGroupMembers" class="modUserGroupMember" local="id" foreign="member" cardinality="many" owner="local" />
 * <composite alias="ActiveUsers" class="modActiveUser" local="id" foreign="internalKey" cardinality="many" owner="local" />
 * </object>
 */
