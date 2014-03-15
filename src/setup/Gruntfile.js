module.exports = function(grunt)
{
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({
        watch: {
            livereload: {
                files: ['app/assets/**', 'public/**', 'app/controllers/**', 'app/models/**', 'app/views/**'],
                options: {
                    livereload: true
                }
            }
        }
    });

    grunt.registerTask('default', 'watch');
}