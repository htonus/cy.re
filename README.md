Overview
=====

TO BUILD META: COMMENT makeSelectHead AND guessAtom IN i18nDAO (unfortunately)

Every i18n object should be inherited from i18n object and has extra table for localized field values:

	<class name="i18n">
		<properties>
			<identifier name="id" />
		</properties>
		<pattern name="AbstractClass" />
	</class>
	
	<class name="Unit" extends="i18n">
		<properties>
			<property name="name" type="String" size="16" required="true" />
			<property name="sign" type="String" size="16" required="true" />
		</properties>
		<pattern name="StraightMapping" />
	</class>

	<class name="Unit_i18n">
		<properties>
			<identifier name="id" />
			<property name="object" type="Unit" relation="OneToOne" required="true" fetch="lazy" />
			<property name="language" type="Language" relation="OneToOne" required="true" fetch="lazy" />
			<property name="name" type="String" size="16" required="true" />
		</properties>
		<pattern name="StraightMapping" />
	</class>

And i18nDAO should override makeSelectHead methof in the following way:

		public function makeSelectHead()
		{
			static $selectHead = array();
			
			if (!isset($selectHead[$className = $this->getObjectName()])) {
				$i18nFields = call_user_func(array($this->getObjectName().self::I18N, 'proto'))->
					getMapping();
				
				$languageField	= $i18nFields['language'];
				$objectField	= $i18nFields['object'];
				
				unset($i18nFields['id']);
				unset($i18nFields['language']);
				unset($i18nFields['object']);
				
				$table = $this->getTable();
				$i18nTable = $table.self::I18N;
				
				$object =
					OSQL::select()->
					from($table)->
					leftJoin(
						$this->i18nTable,
						Expression::andBlock(
							Expression::eq(
								DBField::create(
									$this->getIdName(),
									$table
								),
								DBField::create(
									$this->objectField,
									$this->i18nTable
								)
							),
							Expression::eqId(
								DBField::create(
									$this->languageField,
									$this->i18nTable
								),
								GlobalVar::me()->get('language')
							)
						)
					);
				
				foreach ($this->getFields() as $field) {
					if (isset($i18nFields[$field]))
						$object->get(new DBField($field, $i18nTable));
					else
						$object->get(new DBField($field, $table));
				}
				
				$selectHead[$className] = $object;
			}
			
			return clone $selectHead[$className];
		}
	}
