var Diet = (function($, window) {
    "use strict";

    var init = function() {

        calculateDayMealNutrition('breakfast');
        $('#breakfast-meals input').change(function() {
            calculateDayMealNutrition('breakfast');
        });

        calculateDayMealNutrition('second-breakfast');
        $('#second-breakfast-meals input').change(function() {
            calculateDayMealNutrition('second-breakfast');
        });

        calculateDayMealNutrition('dinner');
        $('#dinner-meals input').change(function() {
            calculateDayMealNutrition('dinner');
        });

        calculateDayMealNutrition('tea');
        $('#tea-meals input').change(function() {
            calculateDayMealNutrition('tea');
        });

        calculateDayMealNutrition('supper');
        $('#supper-meals input').change(function() {
            calculateDayMealNutrition('supper');
        });

        calculateDayTotalNutrition();
    };

    var calculateDayTotalNutrition = function() {
        var calories,
            protein,
            carbs,
            fat;

        calories = parseInt($('#breakfast-calories').html())
            + parseInt($('#second-breakfast-calories').html())
            + parseInt($('#dinner-calories').html())
            + parseInt($('#tea-calories').html())
            + parseInt($('#supper-calories').html());

        protein = parseInt($('#breakfast-protein').html())
            + parseInt($('#second-breakfast-protein').html())
            + parseInt($('#dinner-protein').html())
            + parseInt($('#tea-protein').html())
            + parseInt($('#supper-protein').html());

        carbs = parseInt($('#breakfast-carbs').html())
            + parseInt($('#second-breakfast-carbs').html())
            + parseInt($('#dinner-carbs').html())
            + parseInt($('#tea-carbs').html())
            + parseInt($('#supper-carbs').html());

        fat = parseInt($('#breakfast-fat').html())
            + parseInt($('#second-breakfast-fat').html())
            + parseInt($('#dinner-fat').html())
            + parseInt($('#tea-fat').html())
            + parseInt($('#supper-fat').html());

        $('#day-calories').html(calories);
        $('#day-protein').html(protein);
        $('#day-carbs').html(carbs);
        $('#day-fat').html(fat);
    }

    var calculateDayMealNutrition = function(mealType) {

        var calories = 0;
        var protein = 0;
        var carbs = 0;
        var fat = 0;

        $('#' + mealType + '-meals input:checked').each(function() {
            calories += parseInt($(this).data('calories'));
            protein += parseInt($(this).data('protein'));
            carbs += parseInt($(this).data('carbs'));
            fat += parseInt($(this).data('fat'));
        });

        $('#' + mealType + '-calories').html(calories);
        $('#' + mealType + '-protein').html(protein);
        $('#' + mealType + '-carbs').html(carbs);
        $('#' + mealType + '-fat').html(fat);

        calculateDayTotalNutrition();
    }

    return {
        init: init
    };
})(window.jQuery, window);

$( document ).ready(function() {
    Diet.init();
});