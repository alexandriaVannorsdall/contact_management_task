<?php

include 'config.php';

/**
 * View a list of email addresses in the mailing list, most recently added first
 */
function getEmailList()
{
    global $conn;
    $sql = "SELECT * FROM list_contact ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $emails = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $emails[] = $row;
        }
    }

    return $emails;
}


/**
 * Add a new email address to the list without reloading the page
 */
function addEmailAddress($email, $name) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO list_contact (email_address, name) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $name);

    $result = $stmt->execute();

    $stmt->close();

    if ($result) {
        return true;
    } else {
        return false;
    }
}


/**
 * Delete an email address from the list without reloading the page
 */
function deleteEmailAddress($email) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM list_contact WHERE email_address = ?");

    $stmt->bind_param("s", $email);

    $result = $stmt->execute();

    $stmt->close();

    return $result;
}

// Another possible function to add below

/**
 * Update an email address from the list without reloading the page
 */

