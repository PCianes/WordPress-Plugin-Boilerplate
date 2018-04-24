module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);
	
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		makepot: {
			target: {
				options: {
					domainPath: '/languages/',          // Where to save the POT file.
					potFilename: 'plugin-name.pot', // Name of the POT file.
					type: 'wp-plugin',                // Type of project (wp-plugin or wp-theme).
				}
			}
		},
	
		po2mo: {
			files: {
				src: 'languages/*.po',
				expand: true,
			},
		}
	
	});
	
	// Default task(s).
	grunt.registerTask( 'default', [ 'makepot', 'po2mo' ] );

};