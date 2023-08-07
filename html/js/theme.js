document.addEventListener("DOMContentLoaded", function () {
  console.log("ready");
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridWeek",
    headerToolbar: {
      left: "prev,next",
      center: "title",
      right: "dayGridWeek,dayGridDay" // user can switch between the two
    }
  });

  document.getElementById("next").addEventListener("click", function () {
    calendar.next();
    updateActiveWeek();
  });
  document.getElementById("previous").addEventListener("click", function () {
    calendar.prev();
    updateActiveWeek();
  });
  console.log(calendar);
  // calendar.render();

  // var currentDate = new Date();
  // console.log(currentDate.toJSON());

  function updateActiveWeek() {
    clearActiveDate();
    var startDate = new Date(calendar.currentData.dateProfile.currentRange.start);
    console.log(getLocaleDateObject(startDate));
    startDate = getLocaleDateObject(startDate);
    // var activeWeek = [];

    // console.log(
    // 	startDate.toLocaleDateString("en-US", {
    // 		weekday: "long",
    // 		month: "short",
    // 		day: "numeric",
    // 	})
    // );

    var http = new XMLHttpRequest();
    var url = "../update_active_week.php";
    startDate = startDate.valueOf() / 1000;
    http.open("POST", url, true);

    //Send the proper header information along with the request
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
      //Call a function when the state changes.
      if (http.readyState == 4 && http.status == 200) {
        // console.log(http.responseText);
        document.getElementById("main").innerHTML = http.responseText;
      }
    };
    http.send(startDate);
    // });
  }

  // document.getElementById("submit").addEventListener("click", function (e) {
  // 	e.preventDefault();

  // 	var http = new XMLHttpRequest();
  // 	var url = "../ajax.php";
  // 	http.open("POST", url, true);
  // 	http.setRequestHeader(
  // 		"Content-Type",
  // 		"application/x-www-form-urlencoded"
  // 	);
  // 	http.onreadystatechange = function () {
  // 		//Call a function when the state changes.
  // 		if (http.readyState == 4 && http.status == 200) {
  // 			console.log({mealPlan:mealPlan});
  // 			console.log(http.responseText);
  // 		}
  // 	};
  // 	console.log("Type", typeof mealPlan);
  // 	http.send(JSON.stringify({mealPlan:mealPlan}));

  // });

  $("#submit").click(function (e) {
    e.preventDefault();
    // console.log('jQuery is working');
    // console.log('Type',typeof({plan:mealPlan}));
    $.post("../ajax.php", {
      plan: mealPlan
    }, function (response) {
      console.log(response);
      // document.getElementById("main").innerHTML = response;
    });
  });

  var input = document.querySelectorAll("input[type='text']");
  var mealPlan = [];
  $("#main").on("change", 'input[type="text"]', function (e) {
    var day = $(this).parent();
    var plan = {
      id: day.children().eq(2).val(),
      d_id: day.children().eq(0).val(),
      recipe_name: day.children().eq(1).val()
    };
    mealPlan.push(plan);
    // console.log(mealPlan);
  });
  // input.forEach(function (item) {
  // 	item.addEventListener("change", function (e) {
  // 		var day, id, d_id, recipe_name;
  // 		day = this.closest(".card-text");
  // 		children = day.children;
  // 		// id = children[2].value;
  // 		// d_id = children[0].value;
  // 		// recipe_name = children[1].value;

  // 		var plan = {
  // 			id: children[2].value,
  // 			d_id: children[0].value,
  // 			recipe_name: children[1].value,
  // 		};
  // 		mealPlan.push(plan);
  // 		// console.log(mealPlan);
  // 	});
  // });

  // updateActiveWeek();
});

function shortDate(d) {
  return d.toLocaleDateString("en-US", {
    weekday: "long",
    month: "short",
    day: "numeric"
  });
}
function clearActiveDate() {
  var activeDate = document.querySelectorAll(".card-body.active");
  if (activeDate.length > 0) {
    activeDate[0].classList.remove("active");
  }
}
function getLocaleDateObject(date) {
  var d = new Date();
  let diff = d.getTimezoneOffset() * 60 * 1000;
  // console.log(diff);
  // console.log("StartDate:", new Date(date.valueOf() / 1000 + diff));
  return new Date(date.valueOf() + diff);
}
(function ($) {
  $(".recipe").ready(function () {
    $("#addIngredient").on("click", function (e) {
      e.preventDefault();
      var ing = $('input[name^="recipe[ingredients"]');
      var c = ing.length;
      var clone = ing.last().parent().clone();
      var name = clone.find("input").attr("name");
      name = name.replace(/(\d+)/, c);
      clone.find("input").attr({
        name: name,
        placeholder: "Ingredient " + (c + 1),
        value: ""
      });
      $(this).before(clone);
    });
    $("#addStep").on("click", function (e) {
      e.preventDefault();
      var instruction = $('textarea[name^="recipe[instructions"]');
      var c = instruction.length;
      var clone = instruction.last().parent().clone();
      var name = clone.find("textarea").attr("name");
      name = name.replace(/(\d+)/, c);
      clone.find("textarea").attr({
        name: name,
        placeholder: "Step " + (c + 1)
      });
      clone.find("textarea").val("");
      $(this).before(clone);
    });
    $(".recipe").on("click", "span.input-group-text", function (e) {
      e.preventDefault();
      if ($(this).parent().parent().children(".input-group").length == 1) {
        let error = $(this).parent().parent().find(".invalid-feedback");
        error.removeAttr("style").addClass("d-block");
        window.setTimeout(function () {
          console.log($(this));
          error.fadeOut(1000, function () {
            error.removeClass("d-block");
          });
        }, 5000);
      } else if ($(this).parent().parent().children(".input-group").length > 1) {
        $(this).parent().remove();
      }
    });
  });
})(jQuery);