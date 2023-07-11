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

li.click(function () {
    var name = $(this).attr("data-name");
    var listSubjectActive = $("#listSubjectActive");
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
        listSubjectActive.text("");
        liSelected = null;
    } else {
        li.removeClass("selected");
        $(this).addClass("selected");
        liSelected = $(this);
        listSubjectActive.text(name);
        scrollToSelected();
    }
});

$(window).keydown(function (e) {
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
    var selectedValue = liSelected.text();
    var selectedDataId = liSelected.attr("data-id");
    var name = liSelected.attr("data-name");
    var listSubjectActive = $("#listSubjectActive");

    listSubjectActive.text(name);
    console.log(selectedDataId);
});

function scrollToSelected() {
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
        myEditor = editor;
    })
    .catch((error) => {
        console.error(error);
    });
