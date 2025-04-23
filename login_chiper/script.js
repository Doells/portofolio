function toggleForm() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
}

function togglePasswordVisibility(passwordId) {
    const passwordField = document.getElementById(passwordId);
    const type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
}

function showEncryptionProcess() {
    const text = document.getElementById('inputText').value;
    const cipherType = document.getElementById('demoCipher').value;
    let shiftValue = parseInt(document.getElementById('shiftValue').value);
    let encryptedText = '';
    let processText = '';

    if (cipherType === 'caesar') {
        encryptedText = caesarEncrypt(text, shiftValue);
        processText = `Shift: ${shiftValue}\nOriginal: ${text}\nEncrypted: ${encryptedText}`;
    } else if (cipherType === 'hill') {
        encryptedText = hillEncrypt(text);
        processText = `Original: ${text}\nEncrypted: ${encryptedText}`;
    }

    document.getElementById('encryptedResult').textContent = encryptedText;
    document.getElementById('encryptionProcess').textContent = processText;
}

function caesarEncrypt(str, shift = 3) {
    return str.split('').map(char => {
        let code = char.charCodeAt(0);
        if (char.match(/[a-z]/i)) {
            let base = char === char.toUpperCase() ? 65 : 97;
            return String.fromCharCode((code - base + shift) % 26 + base);
        }
        return char;
    }).join('');
}

function hillEncrypt(text) {
    const key = [[3, 3], [2, 5]];  // Example Hill Cipher key
    text = text.toLowerCase().replace(/[^a-z]/g, ''); // Clean up input
    if (text.length % 2 !== 0) text += 'x';  // Add padding for odd length
    let result = '';
    let process = '';

    for (let i = 0; i < text.length; i += 2) {
        const pair = text.slice(i, i + 2).split('');
        const [x, y] = pair.map(char => char.charCodeAt(0) - 97); // Convert to numbers (0-25)
        const encryptedX = (key[0][0] * x + key[0][1] * y) % 26;
        const encryptedY = (key[1][0] * x + key[1][1] * y) % 26;
        result += String.fromCharCode(encryptedX + 97) + String.fromCharCode(encryptedY + 97);
    }
    return result;
}
