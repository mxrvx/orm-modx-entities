<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Entities;

/**
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PropertyNotSetInConstructor
 */
abstract class Principal extends XSimpleObject {}

/**
 * <object class="modPrincipal" extends="xPDOSimpleObject">
 * <composite alias="Acls" class="modAccess" local="id" foreign="principal" cardinality="many" owner="local" />
 * </object>
 */
