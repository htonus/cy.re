Overview
=====
Object - основной объект системы

Property - его языковые копии

Feautuers / Gallery - должны цепляться к Object



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