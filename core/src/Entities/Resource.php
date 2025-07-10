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
    role: 'modx:Resource',
    table: 'site_content',
)]
#[Index(columns: ['alias'], name: 'alias')]
#[Index(columns: ['published'], name: 'published')]
#[Index(columns: ['pub_date'], name: 'pub_date')]
#[Index(columns: ['unpub_date'], name: 'unpub_date')]
#[Index(columns: ['parent'], name: 'parent')]
#[Index(columns: ['isfolder'], name: 'isfolder')]
#[Index(columns: ['template'], name: 'template')]
#[Index(columns: ['menuindex'], name: 'menuindex')]
#[Index(columns: ['searchable'], name: 'searchable')]
#[Index(columns: ['cacheable'], name: 'cacheable')]
#[Index(columns: ['hidemenu'], name: 'hidemenu')]
#[Index(columns: ['class_key'], name: 'class_key')]
#[Index(columns: ['context_key'], name: 'context_key')]
#[Index(columns: ['uri'], name: 'uri')]
#[Index(columns: ['uri_override'], name: 'uri_override')]
#[Index(columns: ['hide_children_in_tree'], name: 'hide_children_in_tree')]
#[Index(columns: ['show_in_tree'], name: 'show_in_tree')]
#[Index(columns: ['parent', 'menuindex', 'id'], name: 'cache_refresh_idx')]
class Resource extends AccessibleSimpleObject
{
    #[Column(type: 'string(20)', default: 'document', typecast: 'string')]
    public string $type = 'document';

    #[Column(type: 'string(50)', name: 'contentType', default: 'text/html', typecast: 'string')]
    public string $contentType = 'text/html';

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public ?string $pagetitle = null;

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public string $longtitle = '';

    #[Column(type: 'text', nullable: true, typecast: 'string')]
    public ?string $description = '';

    #[Column(type: 'string(191)', nullable: true, default: '', typecast: 'string')]
    public ?string $alias = null;

    #[Column(type: 'boolean', default: true, typecast: 'bool')]
    public bool $alias_visible = true;

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public string $link_attributes = '';

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $published = false;

    #[Column(type: 'int(20)', default: 0, typecast: 'timestamp')]
    public int $pub_date = 0;

    #[Column(type: 'int(20)', default: 0, typecast: 'timestamp')]
    public int $unpub_date = 0;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $parent = 0;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $isfolder = false;

    #[Column(type: 'text', nullable: true, typecast: 'string')]
    public ?string $introtext = null;

    #[Column(type: 'mediumText', nullable: true, default: null, typecast: 'string')]
    public ?string $content = null;

    #[Column(type: 'boolean', default: true, typecast: 'bool')]
    public bool $richtext = true;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $template = 0;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $menuindex = 0;

    #[Column(type: 'boolean', default: true, typecast: 'bool')]
    public bool $searchable = true;

    #[Column(type: 'boolean', default: true, typecast: 'bool')]
    public bool $cacheable = true;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $createdby = 0;

    #[Column(type: 'int(20)', default: 0, typecast: 'timestamp')]
    public int $createdon = 0;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $editedby = 0;

    #[Column(type: 'int(20)', default: 0, typecast: 'timestamp')]
    public int $editedon = 0;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $deleted = false;

    #[Column(type: 'int(20)', default: 0, typecast: 'timestamp')]
    public int $deletedon = 0;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $deletedby = 0;

    #[Column(type: 'int(20)', default: 0, typecast: 'timestamp')]
    public int $publishedon = 0;

    #[Column(type: 'int(10)', default: 0, typecast: 'int')]
    public int $publishedby = 0;

    #[Column(type: 'string(191)', default: '', typecast: 'string')]
    public string $menutitle = '';

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $donthit = false;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $privateweb = false;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $privatemgr = false;

    #[Column(type: 'int(1)', default: 0, typecast: 'int')] ///???
    public int $content_dispo = 0;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $hidemenu = false;

    #[Column(type: 'string(100)', default: 'modDocument', typecast: 'string')]
    public string $class_key = 'modDocument';

    #[Column(type: 'string(100)', default: 'web', typecast: 'string')]
    public string $context_key = 'web';

    #[Column(type: 'int(11)', default: 1, typecast: 'int', unsigned: true)]
    public int $content_type = 1;

    #[Column(type: 'string(191)', nullable: true, typecast: 'string')]
    public ?string $uri = null;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $uri_override = false;

    #[Column(type: 'boolean', default: false, typecast: 'bool')]
    public bool $hide_children_in_tree = false;

    #[Column(type: 'boolean', default: true, typecast: 'bool')]
    public bool $show_in_tree = true;

    #[Column(type: 'mediumText', nullable: true, typecast: 'json')]
    public ?array $properties = null;

    //TODO
}

/**
 * <object class="modResource" table="site_content" extends="modAccessibleSimpleObject" inherit="single">
 * <field key="type" dbtype="varchar" precision="20" phptype="string" null="false" default="document" />
 * <field key="contentType" dbtype="varchar" precision="50" phptype="string" null="false" default="text/html" />
 * <field key="pagetitle" dbtype="varchar" precision="191" phptype="string" null="false" default="" index="fulltext" indexgrp="content_ft_idx" />
 * <field key="longtitle" dbtype="varchar" precision="191" phptype="string" null="false" default="" index="fulltext" indexgrp="content_ft_idx" />
 * <field key="description" dbtype="text" phptype="string" null="false" default="" index="fulltext" indexgrp="content_ft_idx" />
 * <field key="alias" dbtype="varchar" precision="191" phptype="string" null="true" default="" index="index" />
 * <field key="alias_visible" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="1" />
 * <field key="link_attributes" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="published" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" index="index" />
 * <field key="pub_date" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" index="index" />
 * <field key="unpub_date" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" index="index" />
 * <field key="parent" dbtype="int" precision="10" phptype="integer" null="false" default="0" index="index" />
 * <field key="isfolder" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" index="index" />
 * <field key="introtext" dbtype="text" phptype="string" index="fulltext" indexgrp="content_ft_idx" />
 * <field key="content" dbtype="mediumtext" phptype="string" index="fulltext" indexgrp="content_ft_idx" />
 * <field key="richtext" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="1" />
 * <field key="template" dbtype="int" precision="10" phptype="integer" null="false" default="0" index="index" />
 * <field key="menuindex" dbtype="int" precision="10" phptype="integer" null="false" default="0" index="index" />
 * <field key="searchable" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="1" index="index" />
 * <field key="cacheable" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="1" index="index" />
 * <field key="createdby" dbtype="int" precision="10" phptype="integer" null="false" default="0" />
 * <field key="createdon" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" />
 * <field key="editedby" dbtype="int" precision="10" phptype="integer" null="false" default="0" />
 * <field key="editedon" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" />
 * <field key="deleted" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" />
 * <field key="deletedon" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" />
 * <field key="deletedby" dbtype="int" precision="10" phptype="integer" null="false" default="0" />
 * <field key="publishedon" dbtype="int" precision="20" phptype="timestamp" null="false" default="0" />
 * <field key="publishedby" dbtype="int" precision="10" phptype="integer" null="false" default="0" />
 * <field key="menutitle" dbtype="varchar" precision="191" phptype="string" null="false" default="" />
 * <field key="donthit" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" />
 * <field key="privateweb" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" />
 * <field key="privatemgr" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" />
 * <field key="content_dispo" dbtype="tinyint" precision="1" phptype="integer" null="false" default="0" />
 * <field key="hidemenu" dbtype="tinyint" precision="1" attributes="unsigned" phptype="boolean" null="false" default="0" index="index" />
 * <field key="class_key" dbtype="varchar" precision="100" phptype="string" null="false" default="modDocument" index="index" />
 * <field key="context_key" dbtype="varchar" precision="100" phptype="string" null="false" default="web" index="index" />
 * <field key="content_type" dbtype="int" precision="11" attributes="unsigned" phptype="integer" null="false" default="1" />
 * <field key="uri" dbtype="text" phptype="string" null="true" index="index" />
 * <field key="uri_override" dbtype="tinyint" precision="1" phptype="integer" null="false" default="0" index="index" />
 * <field key="hide_children_in_tree" dbtype="tinyint" precision="1" phptype="integer" null="false" default="0" index="index" />
 * <field key="show_in_tree" dbtype="tinyint" precision="1" phptype="integer" null="false" default="1" index="index" />
 * <field key="properties" dbtype="mediumtext" phptype="json" null="true" />
 *
 * <index alias="alias" name="alias" primary="false" unique="false" type="BTREE">
 * <column key="alias" length="" collation="A" null="true" />
 * </index>
 * <index alias="published" name="published" primary="false" unique="false" type="BTREE">
 * <column key="published" length="" collation="A" null="false" />
 * </index>
 * <index alias="pub_date" name="pub_date" primary="false" unique="false" type="BTREE">
 * <column key="pub_date" length="" collation="A" null="false" />
 * </index>
 * <index alias="unpub_date" name="unpub_date" primary="false" unique="false" type="BTREE">
 * <column key="unpub_date" length="" collation="A" null="false" />
 * </index>
 * <index alias="parent" name="parent" primary="false" unique="false" type="BTREE">
 * <column key="parent" length="" collation="A" null="false" />
 * </index>
 * <index alias="isfolder" name="isfolder" primary="false" unique="false" type="BTREE">
 * <column key="isfolder" length="" collation="A" null="false" />
 * </index>
 * <index alias="template" name="template" primary="false" unique="false" type="BTREE">
 * <column key="template" length="" collation="A" null="false" />
 * </index>
 * <index alias="menuindex" name="menuindex" primary="false" unique="false" type="BTREE">
 * <column key="menuindex" length="" collation="A" null="false" />
 * </index>
 * <index alias="searchable" name="searchable" primary="false" unique="false" type="BTREE">
 * <column key="searchable" length="" collation="A" null="false" />
 * </index>
 * <index alias="cacheable" name="cacheable" primary="false" unique="false" type="BTREE">
 * <column key="cacheable" length="" collation="A" null="false" />
 * </index>
 * <index alias="hidemenu" name="hidemenu" primary="false" unique="false" type="BTREE">
 * <column key="hidemenu" length="" collation="A" null="false" />
 * </index>
 * <index alias="class_key" name="class_key" primary="false" unique="false" type="BTREE">
 * <column key="class_key" length="" collation="A" null="false" />
 * </index>
 * <index alias="context_key" name="context_key" primary="false" unique="false" type="BTREE">
 * <column key="context_key" length="" collation="A" null="false" />
 * </index>
 * <index alias="uri" name="uri" primary="false" unique="false" type="BTREE">
 * <column key="uri" length="191" collation="A" null="true" />
 * </index>
 * <index alias="uri_override" name="uri_override" primary="false" unique="false" type="BTREE">
 * <column key="uri_override" length="" collation="A" null="false" />
 * </index>
 * <index alias="hide_children_in_tree" name="hide_children_in_tree" primary="false" unique="false" type="BTREE">
 * <column key="hide_children_in_tree" length="" collation="A" null="false" />
 * </index>
 * <index alias="show_in_tree" name="show_in_tree" primary="false" unique="false" type="BTREE">
 * <column key="show_in_tree" length="" collation="A" null="false" />
 * </index>
 * <index alias="content_ft_idx" name="content_ft_idx" primary="false" unique="false" type="FULLTEXT">
 * <column key="pagetitle" length="" collation="A" null="false" />
 * <column key="longtitle" length="" collation="A" null="false" />
 * <column key="description" length="" collation="A" null="false" />
 * <column key="introtext" length="" collation="A" null="true" />
 * <column key="content" length="" collation="A" null="true" />
 * </index>
 * <index alias="cache_refresh_index" name="cache_refresh_idx" primary="false" unique="false" type="BTREE">
 * <column key="parent" length="" collation="A" null="false" />
 * <column key="menuindex" length="" collation="A" null="false" />
 * <column key="id" length="" collation="A" null="false" />
 * </index>
 *
 * <aggregate alias="Parent" class="modResource" local="parent" foreign="id" cardinality="one" owner="foreign" />
 * <aggregate alias="CreatedBy" class="modUser" local="createdby" foreign="id" cardinality="one" owner="foreign" />
 * <aggregate alias="EditedBy" class="modUser" local="editedby" foreign="id" cardinality="one" owner="foreign" />
 * <aggregate alias="DeletedBy" class="modUser" local="deletedby" foreign="id" cardinality="one" owner="foreign" />
 * <aggregate alias="PublishedBy" class="modUser" local="publishedby" foreign="id" cardinality="one" owner="foreign" />
 * <aggregate alias="Template" class="modTemplate" local="template" foreign="id" cardinality="one" owner="foreign" />
 * <aggregate alias="TemplateVars" class="modTemplateVar" local="id:template" foreign="contentid:templateid" cardinality="many" owner="local" />
 * <aggregate alias="TemplateVarTemplates" class="modTemplateVarTemplate" local="template" foreign="templateid" cardinality="many" owner="local" />
 * <aggregate alias="ContentType" class="modContentType" local="content_type" foreign="id" owner="foreign" cardinality="one" />
 * <aggregate alias="Context" class="modContext" local="context_key" foreign="key" owner="foreign" cardinality="one" />
 * <composite alias="Children" class="modResource" local="id" foreign="parent" cardinality="many" owner="local" />
 * <composite alias="TemplateVarResources" class="modTemplateVarResource" local="id" foreign="contentid" cardinality="many" owner="local" />
 * <composite alias="ResourceGroupResources" class="modResourceGroupResource" local="id" foreign="document" cardinality="many" owner="local" />
 * <composite alias="Acls" class="modAccessResource" local="id" foreign="target" owner="local" cardinality="many" />
 * <composite alias="ContextResources" class="modContextResource" local="id" foreign="resource" cardinality="many" owner="local" />
 * </object>
 */
