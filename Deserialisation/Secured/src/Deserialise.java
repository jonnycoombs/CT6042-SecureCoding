import java.io.*;
import java.util.logging.Level;


public class Deserialise extends ObjectInputStream {

    static Object obj;

    public Deserialise (InputStream inputStream)
            throws IOException {
        super(inputStream);
    }

    /**
     * Only deserialize instances of our expected Bicycle class
     */
    @Override
    protected Class<?> resolveClass(ObjectStreamClass desc) throws IOException,
            ClassNotFoundException {
        if (!desc.getName().equals(userModel.class.getName())) {
            throw new InvalidClassException(
                    "Unauthorized deserialization attempt",
                    desc.getName());
        }
        return super.resolveClass(desc);
    }

    public static Object deserializeToFile(String inputName, Log logging) throws IOException {


        try {


            FileInputStream fileInputStream = new FileInputStream(inputName);
            ObjectInputStream is = new ObjectInputStream(fileInputStream);
            userModel user = (userModel) is.readObject();

//            Logging to ensure if something malicious is processed it will show up in the logs so a developer can fix it
            logging.logger.info("First Name " + user.firstName);
            logging.logger.info("Last Name " + user.lastName);
            logging.logger.info("Email " + user.email);
            obj = is.readObject();




            is.close();
            logging.logger.info("File " + inputName + " created successfully.");
        } catch (
                FileNotFoundException e) {
            logging.logger.severe("File not found exception occurred during file creation." + e.getMessage());
        } catch (
                IOException e) {
            logging.logger.severe("IO Exception occurred during file creation" + e.getMessage());
        } catch (ClassNotFoundException e) {
            logging.logger.severe("Error occurred during file creation." + e.getMessage());
        } catch (Exception e) {
            logging.logger.severe("Error occurred during file creation." + e.getMessage());
        }


        return obj;
    }

    public static void main (String[] args) throws IOException {

        Log logging = new Log("Unsecure_Serialisation.txt");
        logging.logger.setLevel(Level.INFO);

        logging.logger.info("Deserializing");

        deserializeToFile("user.ser", logging);


    }


}