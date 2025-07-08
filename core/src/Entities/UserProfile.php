<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\Annotated\Annotation\Table\Index;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[Entity(role: 'modx:UserProfile', table: 'user_attributes')]
#[Index(columns: ['internalKey'], name: 'internalKey', unique: true)]
class UserProfile extends XSimpleObject
{
    #[Column(type: 'int(10)', typecast: 'int', name: 'internalKey')]
    public ?int $internalKey = null;

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public ?string $fullname = null;

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public ?string $email = null;

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public string $phone = '';

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public string $mobilephone = '';

    #[Column(type: 'boolean', typecast: 'bool', default: false)]
    public bool $blocked = false;

    #[Column(type: 'int(11)', typecast: 'int', default: 0)]
    public int $blockeduntil = 0;

    #[Column(type: 'int(11)', typecast: 'int', default: 0)]
    public int $blockedafter = 0;

    #[Column(type: 'int(11)', typecast: 'int', default: 0)]
    public int $logincount = 0;

    #[Column(type: 'int(11)', typecast: 'int', default: 0)]
    public int $lastlogin = 0;

    #[Column(type: 'int(11)', typecast: 'int', default: 0)]
    public int $thislogin = 0;

    #[Column(type: 'int(10)', typecast: 'int', default: 0)]
    public int $failedlogincount = 0;

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public string $sessionid = '';

    #[Column(type: 'int(10)', typecast: 'int', default: 0)]
    public int $dob = 0;

    #[Column(type: 'int(1)', typecast: 'int', default: 0)]
    public int $gender = 0;

    #[Column(type: 'text', typecast: 'string')]
    public string $address = '';

    #[Column(type: 'string(191)', typecast: 'string', default: '')]
    public string $country = '';

    #[Column(type: 'string(191)', typecast: 'string', default: '')]
    public string $city = '';

    #[Column(type: 'string(25)', typecast: 'string', default: '')]
    public string $state = '';

    #[Column(type: 'string(25)', typecast: 'string', default: '')]
    public string $zip = '';

    #[Column(type: 'string(100)', typecast: 'string', default: '')]
    public string $fax = '';

    #[Column(type: 'string(191)', typecast: 'string', default: '')]
    public string $photo = '';

    #[Column(type: 'text', typecast: 'string')]
    public string $comment = '';

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public string $website = '';

    #[Column(type: 'text', typecast: 'json', nullable: true)]
    public ?array $extended = null;

    /**
     * <code>
     * <aggregate alias="User" class="modUser" local="internalKey" foreign="id" cardinality="one" owner="foreign" />
     * </code>
     *
     */
    #[BelongsTo(target: User::class, innerKey: 'internalKey', outerKey: 'id', nullable: true, fkCreate: false, indexCreate: false)]
    public ?User $User = null;
}

/**
 * <object class="modUserProfile" table="user_attributes" extends="xPDOSimpleObject">
 * <field key="internalKey" dbtype="int" precision="10" phptype="integer" null="false" index="unique" />
 * <field key="fullname" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="email" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="phone" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="mobilephone" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="blocked" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" />
 * <field key="blockeduntil" dbtype="int" precision="11" phptype="integer" null="false" default="0" />
 * <field key="blockedafter" dbtype="int" precision="11" phptype="integer" null="false" default="0" />
 * <field key="logincount" dbtype="int" precision="11" phptype="integer" null="false" default="0" />
 * <field key="lastlogin" dbtype="int" precision="11" phptype="integer" null="false" default="0" />
 * <field key="thislogin" dbtype="int" precision="11" phptype="integer" null="false" default="0" />
 * <field key="failedlogincount" dbtype="int" precision="10" phptype="integer" null="false" default="0" />
 * <field key="sessionid" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="dob" dbtype="int" precision="10" phptype="integer" null="false" default="0" />
 * <field key="gender" dbtype="int" precision="1" phptype="integer" null="false" default="0" />
 * <field key="address" dbtype="text" phptype="string" null="false" default="" />
 * <field key="country" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="city" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="state" dbtype="varchar" precision="25" phptype="string" null="false" default="" />
 * <field key="zip" dbtype="varchar" precision="25" phptype="string" null="false" default="" />
 * <field key="fax" dbtype="varchar" precision="100" phptype="string" null="false" default="" />
 * <field key="photo" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="comment" dbtype="text" phptype="string" null="false" default="" />
 * <field key="website" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="extended" dbtype="text" phptype="json" null="true" index="fulltext" indexgrp="extended" />
 *
 * <index alias="internalKey" name="internalKey" primary="false" unique="true" type="BTREE">
 * <column key="internalKey" length="" collation="A" null="false" />
 * </index>
 *
 * <aggregate alias="User" class="modUser" local="internalKey" foreign="id" cardinality="one" owner="foreign" />
 * </object>
 */
