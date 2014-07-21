$(function(){
    window.Model = {};
    window.Collection = {};
    window.View = {};
    window.Router = {};

    Model.Todo = Backbone.Model.extend({
        urlRoot: '/todo'
    });

    Collection.Todos = Backbone.Collection.extend({
        offset: 0,
        limit: 10,
        url: function () {
            return '/todos/' + this.offset + '/' + this.limit 
        }
    });

    View.TodoList = Backbone.View.extend({
        el: '#todo-list',
        template: _.template($('#list-template').html()),

        initialize: function () {
            _.bindAll(this, 'render');
            this.collection.bind('reset add remove', this.render);
            this.render();
        },

        render: function () {
            this.$el.html(
                this.template({ tasks: this.collection })
            );
        }
    });

    collection = new Collection.Todos();
    collection.fetch();
    window.listView = new View.TodoList({collection: collection});
});