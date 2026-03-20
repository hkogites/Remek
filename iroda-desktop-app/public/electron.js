const { app, BrowserWindow, Menu, ipcMain } = require('electron');
const path = require('path');

// Check if we're in development mode
const isDev = process.env.NODE_ENV === 'development' || 
              process.env.ELECTRON_IS_DEV === 'true' ||
              (app && !app.isPackaged);

let mainWindow;

function createWindow() {
  mainWindow = new BrowserWindow({
    width: 1200,
    height: 800,
    webPreferences: {
      nodeIntegration: false,
      contextIsolation: true,
      enableRemoteModule: false,
      preload: path.join(__dirname, 'preload.js')
    },
    icon: path.join(__dirname, 'icon.png'), // Add an icon file later
    titleBarStyle: 'default',
    show: false
  });

  // Load the app
  mainWindow.loadURL(
    isDev
      ? 'http://localhost:3000'
      : `file://${path.join(__dirname, '../build/index.html')}`
  );

  // Show window when ready to prevent visual flash
  mainWindow.once('ready-to-show', () => {
    mainWindow.show();
  });

  // Handle window closed
  mainWindow.on('closed', () => {
    mainWindow = null;
  });

  // Create menu
  const template = [
    {
      label: 'Fájl',
      submenu: [
        { role: 'quit', label: 'Kilépés' }
      ]
    },
    {
      label: 'Szerkesztés',
      submenu: [
        { role: 'undo', label: 'Visszavonás' },
        { role: 'redo', label: 'Ismétlés' },
        { type: 'separator' },
        { role: 'cut', label: 'Kivágás' },
        { role: 'copy', label: 'Másolás' },
        { role: 'paste', label: 'Beillesztés' }
      ]
    },
    {
      label: 'Nézet',
      submenu: [
        { role: 'reload', label: 'Újratöltés' },
        { role: 'forceReload', label: 'Erőltetett újratöltés' },
        { role: 'toggleDevTools', label: 'Fejlesztői eszközök' },
        { type: 'separator' },
        { role: 'resetZoom', label: 'Eredeti méret' },
        { role: 'zoomIn', label: 'Nagyítás' },
        { role: 'zoomOut', label: 'Kicsinyítés' },
        { type: 'separator' },
        { role: 'togglefullscreen', label: 'Teljes képernyő' }
      ]
    },
    {
      label: 'Ablak',
      submenu: [
        { role: 'minimize', label: 'Minimalizálás' },
        { role: 'close', label: 'Bezárás' }
      ]
    }
  ];

  const menu = Menu.buildFromTemplate(template);
  Menu.setApplicationMenu(menu);
}

// App ready event
app.whenReady().then(createWindow);

// All windows closed event
app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    app.quit();
  }
});

// App activated event (macOS)
app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});

// Security: Prevent new window creation
app.on('web-contents-created', (event, contents) => {
  contents.on('new-window', (event, navigationUrl) => {
    event.preventDefault();
  });
});
