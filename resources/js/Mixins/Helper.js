const Helper = {
    computed: {
        getRecipe() {
            return this.recipe
                ? this.recipe.data
                    ? this.recipe.data
                    : this.recipe
                : {};
        },
        id() {
            return this.getRecipe.id;
        },
        name() {
            return this.getRecipe.name;
        },
        description() {
            return this.getRecipe.description;
        },
        mealType() {
            const uppercase =
                this.getRecipe && this.getRecipe.meal_type
                    ? this.getRecipe.meal_type.substring(0, 1).toUpperCase()
                    : "";
            return `${uppercase}${
                this.getRecipe && this.getRecipe.meal_type
                    ? this.getRecipe.meal_type.substring(1)
                    : ""
            }`;
        },
        cost() {
            return this.getRecipe && this.getRecipe.cost
                ? `$${this.getRecipe.cost}`
                : null;
        },
        status() {
            return this.getRecipe.status;
        },
        instruction() {
            return this.getRecipe.procedure;
        },
        nutrition() {
            return this.getRecipe.nutrition;
        },
        ingredient() {
            return this.getRecipe.ingredient;
        },
        photo() {
            return this.getRecipe.photo;
        },
    },
};

export default Helper;
