import { Tabs } from "flowbite";

/*
 * tabElements: array of tab objects
 * options: optional
 */
const options = {
    onShow: (tab) => {
        var inputElement = document.getElementById("activeTabsInput");
        // Set the value of the input element
        inputElement.value = tab._activeTab.id;
    },
};

const tabElements = [
    {
        id: "profile",
        triggerEl: document.querySelector("#profile-tab"),
        targetEl: document.querySelector("#profile"),
    },
    {
        id: "dashboard",
        triggerEl: document.querySelector("#dashboard-tab"),
        targetEl: document.querySelector("#dashboard"),
    },
    {
        id: "settings",
        triggerEl: document.querySelector("#settings-tab"),
        targetEl: document.querySelector("#settings"),
    },
];
const tabs = new Tabs(tabElements, options);

// console.log(tabs.getActiveTab());

var li = $("#chatContainer li");
var liSelected;
var container = $("#chatContainer");
$(document).on("click", "#chatContainer li", function () {
    var liS = $(".selected");

    var name = $(this).attr("data-name");
    var listSubjectActive = $("#listSubjectActive");
    if ($(this).hasClass("selected")) {
        liS.removeClass("selected");
        $(this).removeClass("selected");
        listSubjectActive.text("");
        liSelected = null;
    } else {
        li.removeClass("selected");
        liS.removeClass("selected");
        $(this).addClass("selected");
        liSelected = $(this);
        listSubjectActive.text(name);
        scrollToSelected();
    }
});

$(document).on("keydown", function (e) {
    var li = $("#chatContainer li");
    // var liSelected = $(".selected");
    if (e.which === 40) {
        if (liSelected) {
            liSelected.removeClass("selected");
            var next = liSelected.next("li");
            if (next.length > 0) {
                liSelected = next.addClass("selected");
            } else {
                liSelected = li.eq(0).addClass("selected");
            }
        } else {
            liSelected = li.eq(0).addClass("selected");
        }
        scrollToSelected();
    } else if (e.which === 38) {
        if (liSelected) {
            liSelected.removeClass("selected");
            var prev = liSelected.prev("li");
            if (prev.length > 0) {
                liSelected = prev.addClass("selected");
            } else {
                liSelected = li.last().addClass("selected");
            }
        } else {
            liSelected = li.last().addClass("selected");
        }
        scrollToSelected();
    }
    if (liSelected) {
        var selectedValue = liSelected.text();
        var selectedDataId = liSelected.attr("data-id");
        var name = liSelected.attr("data-name");
        var listSubjectActive = $("#listSubjectActive");
    
        listSubjectActive.text(name);
        console.log(selectedDataId);
    }

});

function scrollToSelected() {
    console.log(liSelected);
    if (liSelected) {
        var selectedId = liSelected.attr("id");
        var selectedElement = document.getElementById(selectedId);

        if (selectedElement) {
            // selectedElement.scrollIntoView({ behavior: "smooth", block: "center" });
            selectedElement.scrollIntoView({
                behavior: "smooth",
                block: "center",
                inline: "nearest",
            });
        }
    }
}

// Burger Option

const burgerButton = document.getElementById("burger-button");
const optionsBurger = document.getElementById("options");


window.myEditors = null; // Declare the global variable


burgerButton.addEventListener("click", () => {
    optionsBurger.classList.toggle("hidden");
});

BalloonEditor.create(document.querySelector("#chatMessagetextRight"), {
    width: "100%",
    placeholder: "Message...", // Set the placeholder text
    toolbar: {
        items: [
            "link",
            // More toolbar items.
            // ...
        ],
    },
    toolbarSize: "10px", // Set the toolbar size to small
    link: {
        // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
        addTargetToExternalLinks: true,

        // Let the users control the "download" attribute of each link.
        decorators: [
            {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "download",
                },
            },
        ],
    },
})
    .then((editor) => {
        console.log("Editor was initialized", editor);
        // myEditor = editor;
        window.myEditors = editor; // Assign the editor to the global variable

    })
    .catch((error) => {
        console.error(error);
    });

// function loadEmails() {
//     axios
//         .get("/chat/showchats/all")
//         .then(function (response) {
//             // Clear the email list
//             $("#chatContainer").empty();

//             // Append each email item to the list
//             response.data.forEach(function (email) {
//                 var listItem =
//                     '<li x-data="{ countMessage: ' +
//                     email.countMessage +
//                     ' }" ' +
//                     'class="pl-2 py-2 cursor-pointer drop-shadow-lg mb-2 block max-w-sm p-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" ' +
//                     'data-id="Uji Coba" data-name="' +
//                     email.name +
//                     '" id="' +
//                     email.id +
//                     '">' +
//                     '<div class="flex">' +
//                     '<div class="mr-4 flex items-stretch">' +
//                     '<img src="{{ asset(\'profiles/60111.jpg\') }}" alt="Image" class="w-10 h-15 self-center">' +
//                     "</div>" +
//                     '<div class="w-full">' +
//                     '<p class="text-xs font-medium"><strong>Subject</strong>: ' +
//                     '<span class="text-xs">' +
//                     email.name +
//                     "</span>" +
//                     "</p>" +
//                     '<p class="text-xs font-medium">With: ' +
//                     email.with +
//                     "</p>" +
//                     '<p class="text-xs font-bold">' +
//                     email.dateRange +
//                     "</p>" +
//                     "</div>" +
//                     '<div class="flex items-stretch">' +
//                     '<span class=" w-5 h-5 self-center" onclick="alert(\'klikini\')" x-show="countMessage > 0">' +
//                     '<i class="fa-solid fa-chevron-right"></i>' +
//                     "</span>" +
//                     "</div>" +
//                     "</div>" +
//                     "</li>";

//                 $("#chatContainer").append(listItem);
//             });
//         })
//         .catch(function (error) {
//             console.error(error);
//         });
// }

// loadEmails();
