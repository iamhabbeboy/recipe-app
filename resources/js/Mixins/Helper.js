const Helper = {
    computed: {
        getRecipe() {
            return this.recipe
                ? this.recipe.data
                    ? this.recipe.data
                    : this.recipe
                : {};
        },
        name() {
            return this.getRecipe.name;
        },
        description() {
            return this.getRecipe.description;
        },
        mealType() {
            const uppercase = this.getRecipe.meal_type
                .substring(0, 1)
                .toUpperCase();
            return `${uppercase}${this.getRecipe.meal_type.substring(1)}`;
        },
        cost() {
            return this.getRecipe ? `$${this.getRecipe.cost}` : null;
        },
        status() {
            return this.getRecipe.status;
        },
        instruction() {
            return this.getRecipe.tags;
        },
    },
};

export default Helper;
