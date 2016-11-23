class Main {
    private static bool all = false;
    [CCode (array_length = false, array_null_terminated = true)]
    private static string[] packages;

    private const OptionEntry[] options = {
        // { longname, shortname, flags, argument, argument data (ref), description, arg description }
        { "all", 0, 0, OptionArg.NONE, ref all, "Generate documentation for all packages", null },
        { "", 0, 0, OptionArg.FILENAME_ARRAY, ref packages, "Packages", "PACKAGE..." },
        { null }
    };

    public static int main (string[] args) {
        Environment.set_variable ("G_MESSAGES_DEBUG", "all", false);

        try {
            var ctx = new OptionContext ("- extract Vala documentation into XML files");
            ctx.set_help_enabled (true);
            ctx.add_main_entries (options, null);
            ctx.parse (ref args);
        } catch (OptionError e) {
            stderr.printf ("Error: %s\n", e.message);
            stderr.printf ("Try '%s --help' for more information\n", args[0]);
            return 1;
        }

        if (all) {
            info ("generating docs for all packages");
        } else {
            foreach (string x in packages)
                print ("%s ", x);
        }

        return 0;
    }
}
