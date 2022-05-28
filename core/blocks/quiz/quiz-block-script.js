const { registerBlockType } = wp.blocks;

registerBlockType(
	'quize-manager/quiz-block',
	{
		title: 'Quiz Manager Quiz',
		description: 'Block that generates list of questions',
		icon: 'dashicons-welcome-write-blog',
		category: 'layout',
		attributes: {},
		save: function () {
			return null;
		},
		edit: function () {
			return wp.element.createElement( 'p', '', 'Quiz block generated successfully. It can be viewed in front end.' );
		}
	}
)
