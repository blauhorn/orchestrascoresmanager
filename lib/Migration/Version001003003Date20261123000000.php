<?php

declare(strict_types=1);

namespace OCA\OrchestraScoresManager\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * Add optional tempo and concert-pitch key metadata to scores.
 *
 * @psalm-suppress UnusedClass - Migration class discovered by NextCloud framework
 */
class Version001003003Date20261123000000 extends SimpleMigrationStep {
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		$schema = $schemaClosure();
		if ($schema->hasTable('osm_scores')) {
			$table = $schema->getTable('osm_scores');
			if (!$table->hasColumn('tempo_bpm')) {
				$table->addColumn('tempo_bpm', Types::INTEGER, [
					'notnull' => false,
				]);
			}
			if (!$table->hasColumn('musical_key')) {
				$table->addColumn('musical_key', Types::STRING, [
					'notnull' => false,
					'length' => 255,
				]);
			}
		}
		return $schema;
	}
}
