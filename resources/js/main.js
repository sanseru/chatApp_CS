import {
    Tabs
} from 'flowbite';

/*
 * tabElements: array of tab objects
 * options: optional
 */
const options = {
    onShow: (tab) => {
        var inputElement = document.getElementById("activeTabsInput");
        // Set the value of the input element
        inputElement.value = tab._activeTab.id;

        var activeTabValue = tab._activeTab.id;
    }
};

const tabElements = [
    {
        id: 'profile',
        triggerEl: document.querySelector('#profile-tab'),
        targetEl: document.querySelector('#profile')
    },
    {
        id: 'dashboard',
        triggerEl: document.querySelector('#dashboard-tab'),
        targetEl: document.querySelector('#dashboard')
    },
    {
        id: 'settings',
        triggerEl: document.querySelector('#settings-tab'),
        targetEl: document.querySelector('#settings')
    }
];
const tabs = new Tabs(tabElements, options);

// console.log(tabs.getActiveTab());
