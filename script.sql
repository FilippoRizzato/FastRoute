CREATE TABLE Utente (
                        ID INT AUTO_INCREMENT PRIMARY KEY,
                        Nome VARCHAR(50),
                        Cognome VARCHAR(50),
                        Email VARCHAR(100) UNIQUE,
                        Password VARCHAR(255),
                        TemaColore VARCHAR(20)
);

CREATE TABLE Cliente (
                         ID INT AUTO_INCREMENT PRIMARY KEY,
                         Nome VARCHAR(50),
                         Cognome VARCHAR(50),
                         Indirizzo VARCHAR(255),
                         Telefono VARCHAR(15),
                         Email VARCHAR(100) UNIQUE
);

CREATE TABLE Spedizione (
                            ID INT AUTO_INCREMENT PRIMARY KEY,
                            MittenteID INT,
                            DestinatarioID INT,
                            Stato ENUM('in partenza', 'in transito', 'consegnato'),
                            DataSpedizione DATETIME,
                            DataConsegna DATETIME,
                            DataRitiro DATETIME,
                            FOREIGN KEY (MittenteID) REFERENCES Cliente(ID),
                            FOREIGN KEY (DestinatarioID) REFERENCES Cliente(ID)
);

CREATE TABLE RichiestaInformazioni (
                                       ID INT AUTO_INCREMENT PRIMARY KEY,
                                       Nome VARCHAR(50),
                                       Email VARCHAR(100),
                                       Messaggio TEXT,
                                       DataRichiesta DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Utente (Nome, Cognome, Email, Password, TemaColore) VALUES
                                                                    ('Mario', 'Rossi', 'mario.rossi@example.com', 'Password1!', 'blue'),
                                                                    ('Giulia', 'Bianchi', 'giulia.bianchi@example.com', 'Password2!', 'green'),
                                                                    ('Luca', 'Verdi', 'luca.verdi@example.com', 'Password3!', 'red');

INSERT INTO Cliente (Nome, Cognome, Indirizzo, Telefono, Email) VALUES
                                                                    ('Alessandro', 'Neri', 'Via Roma 1, Milano', '0123456789', 'alessandro.neri@example.com'),
                                                                    ('Francesca', 'Gialli', 'Corso Italia 2, Roma', '0987654321', 'francesca.gialli@example.com'),
                                                                    ('Marco', 'Blu', 'Piazza Venezia 3, Napoli', '1234567890', 'marco.blu@example.com');

INSERT INTO Spedizione (MittenteID, DestinatarioID, Stato, DataSpedizione) VALUES
                                                                               (1, 1, 'in partenza', '2023-10-01 10:00:00'),
                                                                               (2, 2, 'in transito', '2023-10-02 11:00:00'),
                                                                               (3, 3, 'consegnato', '2023-10-03 12:00:00');

INSERT INTO RichiestaInformazioni (Nome, Email, Messaggio) VALUES
                                                               ('Simone', 'simone@example.com', 'Vorrei informazioni sui vostri servizi.'),
                                                               ('Laura', 'laura@example.com', 'Quali sono i tempi di consegna?'),
                                                               ('Giorgio', 'giorgio@example.com', 'Offrite servizi internazionali?');