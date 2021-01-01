/**
 * Created on 03/12/2020
 * @author Jonathan Coombs s1704616@glos.ac.uk
 */

import java.io.*;
import java.util.logging.Level;

public class serialisationController {

    public static void main (String[] args) throws IOException {

        Log logging = new Log("Unsecure_Serialisation.txt");
        logging.logger.setLevel(Level.INFO);

        logging.logger.info("Program Arguments:");
        for (String arg : args) {
            logging.logger.info("\t" + arg);
        }

        String outputName = "user.ser";

            userModel jonny = new userModel();
            jonny.firstName = "Jonny";
            jonny.lastName = "Coombs";
            jonny.email = "s1704616@glos.ac.uk";


            try {
                ObjectOutputStream os = new ObjectOutputStream(new FileOutputStream(outputName));
                os.writeObject(jonny);
                os.close();
                logging.logger.info("File " + outputName + " created successfully.");
            } catch (FileNotFoundException e) {
                logging.logger.severe("File not found exception occurred during file creation." + e.getMessage());
            } catch (IOException e) {
                logging.logger.severe("IO Exception occurred during file creation" + e.getMessage());
            } catch (Exception e) {
                logging.logger.severe("Error occurred during file creation." + e.getMessage());
            }

            logging.logger.info("Closing output stream and ending program.");


    }

}
